<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookingStudio;
use App\Models\Ruangan;
use App\Models\HargaSewa;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    
    public function userIndex()
    {
        $userId = auth()->id();
        $bookings = BookingStudio::where('user_id', $userId)->orderBy('created_at', 'desc')->get();

        return view('frontend.bookingfr.index', compact('bookings'));
    }

    public function create()
    {
        $ruangan = Ruangan::all();
        return view('frontend.bookingfr.form', compact('ruangan'));
    }

    public function storeFrontend(Request $request)
    {
        $request->validate([
            'nama_pemesan' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'ruangan_id' => 'required|exists:ruangan,id',
        ]);

        $conflict = BookingStudio::where('tanggal', $request->tanggal)
            ->where('ruangan_id', $request->ruangan_id)
            ->where(function ($query) use ($request) {
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

        $user = auth()->user();

        // Ambil 2 huruf pertama nama user tanpa spasi
        $inisial = strtoupper(substr(preg_replace('/\s+/', '', $user->nama), 0, 2));

        // Hitung jumlah booking oleh user ini
        $jumlahBooking = BookingStudio::where('user_id', $user->id)->count() + 1;
        $urutan = str_pad($jumlahBooking, 2, '0', STR_PAD_LEFT);

        // Ambil ID user
        $userId = str_pad($user->id, 2, '0', STR_PAD_LEFT);

        // Ambil bulan dan tahun saat ini (format MMYY)
        $bulanTahun = \Carbon\Carbon::now()->format('my');

        // Gabungkan jadi kode booking
        $kode_booking = 'BOOK-' . $inisial . $urutan . $userId . $bulanTahun;

        BookingStudio::create([
            'user_id' => $user->id,
            'kode_booking' => $kode_booking,
            'nama_pemesan' => $request->nama_pemesan,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'ruangan_id' => $request->ruangan_id,
            'status' => 'pending',
        ]);

        return redirect()->route('beranda')->with('success', 'Booking berhasil dibuat!');
    }


    public function restore($id)
    {
        $booking = BookingStudio::findOrFail($id);

        // Hanya booking yang dibatalkan yang boleh diaktifkan ulang
        if ($booking->status === 'cancelled') {
            $booking->status = 'pending';
            $booking->save();

            return redirect()->back()->with('success', 'Booking berhasil diaktifkan kembali.');
        }

        return redirect()->back()->with('success', 'Booking tidak dapat diaktifkan.');
    }

        public function cancel($id)
    {
        $booking = BookingStudio::findOrFail($id);

        // Pastikan hanya booking dengan status pending yang bisa dibatalkan
        if ($booking->status === 'pending') {
            $booking->status = 'cancelled';
            $booking->save();
            return redirect()->back()->with('success', 'Booking berhasil dibatalkan.');
        }

        return redirect()->back()->with('error', 'Booking tidak bisa dibatalkan.');
    }

    public function show($id)
    {
        $booking = BookingStudio::with('ruangan.hargaSewas')->findOrFail($id);
        return view('frontend.pembayaran.index', compact('booking'));
    }

    public function getHargaRuangan($id)
    {
        // Ambil salah satu harga dari ruangan itu (misalnya tipe reguler)
        $harga = HargaSewa::where('ruangan_id', $id)->first();

        if ($harga) {
            return response()->json(['harga' => $harga->harga]);
        } else {
            return response()->json(['harga' => 0]);
        }
    }

}
