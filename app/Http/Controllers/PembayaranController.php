<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\BookingStudio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\PDF;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayaran = BookingStudio::with(['user', 'pembayaran']) // pastikan relasi ini bener
            ->orderByDesc('created_at')
            ->get();

        return view('backend.pembayaran.index', compact('pembayaran'));
    }

    public function create()
    {
        $booking = BookingStudio::all();
        return view('backend.pembayaran.create', compact('booking'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:booking_studio,id',
            'kode_booking' => 'required|string',
            'nama_pemesan' => 'required|string',
            'tanggal_booking' => 'required|date',
            'total_pembayaran' => 'required|numeric',
        ]);

        // Cek dulu kalau sudah ada pembayaran sebelumnya
        $cekPembayaran = Pembayaran::where('booking_id', $request->booking_id)->first();
        if ($cekPembayaran) {
            return redirect()->back()->with('success', 'Pembayaran sudah ada untuk booking ini.');
        }

        // Simpan pembayaran baru
        Pembayaran::create([
            'booking_id' => $request->booking_id,
            'kode_booking' => $request->kode_booking,
            'nama_pemesan' => $request->nama_pemesan,
            'tanggal_booking' => $request->tanggal_booking,
            'total_pembayaran' => $request->total_pembayaran,
            'status' => 'paid', // langsung dianggap lunas
        ]);

        return redirect()->route('backend.pembayaran.index')->with('success', 'Pembayaran berhasil dibuat.');
    }


    public function markAsPaid($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->status = 'paid';
        $pembayaran->save();

        return redirect()->back()->with('success', 'Pembayaran lunas.');
    }

    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->delete();

        return redirect()->back()->with('success', 'Data pembayaran berhasil dihapus.');
    }

    public function pembayaranLunas()
    {
        $pembayaran = Pembayaran::with('booking')
            ->where('status', 'paid')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('backend.pembayaran.lunas', compact('pembayaran'));
    }

    public function show($id)
    {
        $booking = BookingStudio::with('ruangan.hargaSewas')->findOrFail($id);
        return view('frontend.pembayaran.form', compact('booking'));
    }

    public function upload(Request $request, $id)
    {
        $booking = BookingStudio::findOrFail($id);

        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Simpan bukti pembayaran
        $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');

        // Buat data pembayaran dan tandai lunas
        Pembayaran::create([
            'booking_id' => $booking->id,
            'kode_booking' => $booking->kode_booking,
            'nama_pemesan' => $booking->nama_pemesan,
            'tanggal_booking' => $booking->tanggal,
            'total_pembayaran' => $booking->harga_total, // pastikan kolom ini ada
            'bukti_pembayaran' => $path,
            'status' => 'paid',
        ]);

        return redirect()->route('dashboard')->with('success', 'Pembayaran berhasil dikirim.');
    }

    public function showFrontend($id)
    {
        $booking = BookingStudio::findOrFail($id);
        return view('frontend.pembayaran.form', compact('booking'));
    }

    public function storeFrontend(Request $request, $id)
    {
        $booking = BookingStudio::with('ruangan.hargaSewas')->findOrFail($id);

        // Ambil harga ruangan
        $harga = $booking->ruangan->hargaSewas->first()->harga ?? 0;

        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'total_pembayaran' => ['required', 'numeric', 'min:' . $harga],
        ], [
            'total_pembayaran.min' => 'Jumlah pembayaran tidak boleh kurang dari harga ruangan yaitu Rp ' . number_format($harga, 0, ',', '.'),
        ]);

        // Upload bukti pembayaran
        $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');

        $pembayaran = Pembayaran::create([
            'booking_id' => $booking->id,
            'kode_booking' => $booking->kode_booking,
            'nama_pemesan' => $booking->nama_pemesan,
            'tanggal_booking' => $booking->tanggal,
            'total_pembayaran' => $request->total_pembayaran,
            'status' => 'paid',
            'bukti_pembayaran' => $path,
        ]);

        // Update status booking
        $booking->update(['status' => 'paid']);

        return redirect()->route('booking.user.index')->with('success', 'Pembayaran berhasil! <a href="'.route('pembayaran.struk', $pembayaran->id).'" target="_blank" style="color: #fff;"><b>📄 Cetak Struk</b></a>');
    }

    public function userIndex()
    {
        $userId = auth()->id();
        $booking = BookingStudio::where('user_id', $userId)->orderBy('created_at', 'desc')->get();
        return view('frontend.booking.index', compact('booking'));
    }

    public function generateStruk($id)
    {
        $pembayaran = Pembayaran::with('booking')->findOrFail($id);

        $pdf = PDF::loadView('frontend.pembayaran.struk', compact('pembayaran'))->setPaper('a5', 'portrait');

        return $pdf->download('Struk-Pembayaran-' . $pembayaran->kode_booking . '.pdf');
    }


}
