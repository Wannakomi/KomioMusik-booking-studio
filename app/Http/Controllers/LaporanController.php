<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\BookingStudio;
use App\Models\Ruangan;
use App\Models\User;

class LaporanController extends Controller
{
    public function transaksiPeriode()
    {
        return view('backend.laporan.transaksi');
    }

    public function hasilTransaksiPeriode(Request $request)
    {
        $request->validate([
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
        ]);

        $pembayaran = Pembayaran::whereBetween('tanggal_booking', [
            $request->tanggal_awal,
            $request->tanggal_akhir
        ])->where('status', 'paid')->orderBy('tanggal_booking', 'asc')->get();

        return view('backend.laporan.hasil_transaksi', [
            'pembayaran' => $pembayaran,
            'tanggal_awal' => $request->tanggal_awal,
            'tanggal_akhir' => $request->tanggal_akhir,
        ]);
    }

    public function ruanganTerfavorit()
    {
        $ruangan = BookingStudio::select('ruangan_id', DB::raw('count(*) as jumlah'))
            ->groupBy('ruangan_id')
            ->with('ruangan')
            ->orderByDesc('jumlah')
            ->get()
            ->map(function ($item) {
                return (object)[
                    'ruangan' => $item->ruangan->nama ?? 'Tanpa Nama',
                    'jumlah' => $item->jumlah,
                ];
            });

        return view('backend.laporan.ruangan_terfavorit', compact('ruangan'));
    }

    public function keuangan()
    {
        $totalPemasukan = Pembayaran::where('status', 'paid')->sum('total_pembayaran');
        return view('backend.laporan.keuangan', compact('totalPemasukan'));
    }

    public function bookingPerBulan()
    {
        $judul = 'Laporan Booking per Bulan';
        // ambil data booking grup berdasarkan bulan
        $data = BookingStudio::selectRaw('DATE_FORMAT(tanggal, "%Y-%m") as bulan, COUNT(*) as total')
            ->groupBy('bulan')
            ->orderBy('bulan', 'desc')
            ->get();

        return view('backend.laporan.bulan', compact('judul', 'data'));
    }


    public function userAktif()
    {
        $judul = 'User Aktif';
        $data = User::where('status', 1)->get();

        return view('backend.laporan.user', compact('judul', 'data'));
    }

    public function exportPDF()
    {
        $data = BookingStudio::with(['user', 'ruangan', 'pembayaran'])
                ->orderBy('created_at', 'desc')
                ->get();

            // Debugging - check if data exists
            if ($data->isEmpty()) {
                return back()->with('error', 'Tidak ada data booking');
            }

        // Get all paid payments with booking and room information
        $pembayaran = Pembayaran::with(['booking.ruangan'])
            ->where('status', 'paid')
            ->get();    

        // Calculate total
        $total = $pembayaran->sum('total_pembayaran');

        $pdf = Pdf::loadView('backend.laporan.pdf', [
            'data' => $data,
            'pembayaran' => $pembayaran,
            'total' => $total
        ]);

        return $pdf->download('laporan-booking-'.now()->format('Y-m-d').'.pdf');
    }

}
