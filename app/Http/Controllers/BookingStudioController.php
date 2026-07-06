<?php

namespace App\Http\Controllers;

use App\Models\BookingStudio;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class BookingStudioController extends Controller
{
    public function index(Request $request)
    {
        \Log::info('Filter request:', [
        'tanggal' => $request->tanggal,
        'ruangan_id' => $request->ruangan_id,
        ]);

        $query = BookingStudio::with('ruangan');

        if ($request->filled('tanggal')) {
            $tanggal = date('Y-m-d', strtotime($request->tanggal));
            $query->whereDate('tanggal', $tanggal);
        }

        if ($request->filled('ruangan_id')) {
            $query->where('ruangan_id', intval($request->ruangan_id));
        }

        $dataBooking = $query->get();
        $ruangans = Ruangan::all();

        return view('backend.booking.index', compact('dataBooking', 'ruangans'));
    }

    public function edit($id)
    {
        $booking = BookingStudio::findOrFail($id);
        $ruangan = Ruangan::all();
        $user = User::all();

        return view('backend.booking.edit', compact('booking', 'ruangan', 'user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'nama_pemesan' => 'required',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'ruangan_id' => 'required|exists:ruangan,id',
        ]);

        $booking = BookingStudio::findOrFail($id);

        $conflict = BookingStudio::where('id', '!=', $id)
            ->where('tanggal', $request->tanggal)
            ->where('ruangan_id', $request->ruangan_id)
            ->where(function($query) use ($request) {
                $query->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
                    ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai])
                    ->orWhere(function ($query) use ($request) {
                        $query->where('jam_mulai', '<=', $request->jam_mulai)
                              ->where('jam_selesai', '>=', $request->jam_selesai);
                    });
            })->exists();

        if ($conflict) {
            return back()->withErrors(['msg' => 'Waktu booking bentrok dengan jadwal lain!'])->withInput();
        }

        $booking->update($request->all());
        return redirect()->route('backend.booking.index')->with('success', 'Booking berhasil diupdate.');
    }

    public function destroy($id)
    {
        $booking = BookingStudio::findOrFail($id);

        // Hapus pembayaran jika ada
        if ($booking->pembayaran) {
            $booking->pembayaran->delete();
        }

        $booking->delete();

        return redirect()->route('backend.booking.index')->with('success', 'Data booking berhasil dihapus.');
    }

    public function show($id)
    {
        $booking = BookingStudio::with(['user', 'ruangan'])->findOrFail($id);
        return view('backend.booking.show', compact('booking'));
    }


}
