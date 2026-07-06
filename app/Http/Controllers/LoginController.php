<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
        // ===================== BACKEND LOGIN =====================

    protected function authenticated($request, $user)
    {
        if ($user->role == 0) {
            return redirect()->intended('/backend/beranda');
        } elseif ($user->role == 1) {
            return redirect()->intended('/beranda');
        } else {
            return redirect()->intended('/');
        }
    }
    
    public function loginBackend()
    {
        return view('backend.v_login.login', [
            'judul' => 'Login',
        ]);
        }

    public function authenticateBackend(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            $user = Auth::guard('admin')->user();

            if ($user->role == 0 && $user->status == 1) {
                return redirect()->intended('/backend/beranda');
            }

            Auth::guard('admin')->logout();
            return redirect()->route('backend.login')->withErrors(['email' => 'Akun anda bukan admin.']);
        }
        return redirect()->route('backend.login')->withErrors(['email' => 'Email atau password salah.']);
    }

    public function logoutBackend(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('backend.login');
    }


        // ===================== FRONTEND LOGIN =====================

    public function loginFrontend()
    {
        return view('auth.login');
    }

    public function authenticateFrontend(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

                // Cek role frontend
            if ($user->role != 1) {
                Auth::logout();
                return redirect()->route('login')->withErrors([
                    'email' => 'Anda tidak diizinkan login dari sini.'
                ]);
            }

            return redirect()->intended('/beranda');
        }

        return redirect()->back()->withErrors([
            'email' => 'Login gagal. Email atau password salah.'
            ]);
    }
        
    public function logoutFrontend(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }


        // ===================== FRONTEND REGISTER =====================

    public function registerFrontend()
    {
        return view('auth.register');
    }

    public function registerFrontendPost(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:user,email',
            'hp' => 'required|string|max:20',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'hp' => $request->hp,
            'password' => bcrypt($request->password),
            'role' => 1, // Default role untuk customer
            'status' => 1, // Default aktif
        ]);

        return redirect()->route('login')->with('success', 'Pendaftaran berhasil, silakan login.');
    }
    

        
}
