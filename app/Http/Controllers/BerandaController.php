<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruangan;
use App\Models\Review;
use App\Models\BookingStudio;
use Illuminate\Support\Facades\DB;
use App\Models\Pembayaran;

class BerandaController extends Controller
{
    public function berandaBackend()
    {
        // 📊 Grafik Rating per Bulan
        $ratingPerBulan = \DB::table('reviews')
            ->selectRaw("MONTH(created_at) as bulan, ROUND(AVG(rating), 2) as rata_rating")
            ->whereYear('created_at', now()->year)
            ->groupByRaw('MONTH(created_at)')
            ->orderByRaw('MONTH(created_at)')
            ->get();

        $dataRatingPerBulan = [];

        for ($i = 1; $i <= 12; $i++) {
            $rating = $ratingPerBulan->firstWhere('bulan', $i);
            $dataRatingPerBulan[] = $rating ? $rating->rata_rating : 0;
        }

        // 📊 Grafik Ruangan Terfavorit
        $ruanganData = \DB::table('booking_studio')
            ->join('ruangan', 'booking_studio.ruangan_id', '=', 'ruangan.id')
            ->select('ruangan.nama as ruangan', \DB::raw('COUNT(*) as jumlah'))
            ->groupBy('ruangan.id', 'ruangan.nama')
            ->orderByDesc('jumlah')
            ->get();


        $labels = $ruanganData->pluck('ruangan');
        $data = $ruanganData->pluck('jumlah');

        // 💰 Data Keuangan
       $jumlahLunas = \DB::table('pembayaran')
            ->join('booking_studio', 'pembayaran.booking_id', '=', 'booking_studio.id')
            ->where('pembayaran.status', 'paid')
            ->distinct('booking_studio.user_id')
            ->count('booking_studio.user_id');

        $totalPendapatan = Pembayaran::where('status', 'paid')->sum('total_pembayaran');
        $totalPembayaran = Pembayaran::sum('total_pembayaran');
        $totalBooking = BookingStudio::count();

        // 📈 Grafik Booking per Bulan
        $dataPerBulan = BookingStudio::selectRaw('MONTH(tanggal) as bulan, COUNT(*) as jumlah')
            ->whereYear('tanggal', now()->year)
            ->groupByRaw('MONTH(tanggal)')
            ->orderByRaw('MONTH(tanggal)')
            ->get();


        $bulanIndo = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        $labelsPerBulan = [];
        $dataPerBulanChart = [];

        for ($i = 1; $i <= 12; $i++) {
            $labelsPerBulan[] = $bulanIndo[$i];
            $jumlah = $dataPerBulan->firstWhere('bulan', $i);
            $dataPerBulanChart[] = $jumlah ? $jumlah->jumlah : 0;
        }

        // 🔁 Kirim ke view
        return view('backend.v_beranda.index', [
            'judul' => 'Beranda',
            'sub' => 'Halaman Beranda',
            'labels' => $labels,
            'data' => $data,
            'totalPendapatan' => $totalPendapatan,
            'totalPembayaran' => $totalPembayaran,
            'totalBooking' => $totalBooking,
            'labelsPerBulan' => $labelsPerBulan,
            'dataPerBulanChart' => $dataPerBulanChart,
            'jumlahLunas' => $jumlahLunas,
            'dataRatingPerBulan' => $dataRatingPerBulan,
        ]);
    }

    public function index()
    {
        $ruangan = Ruangan::orderBy('updated_at', 'desc')->paginate(3); 
        $reviews = Review::with('user')->where('is_hidden', false)->latest()->take(5)->get();
        return view('beranda.index', [ 
            'judul' => 'Halaman Beranda', 
            'ruangan' => $ruangan, 
            'reviews' => $reviews,
        ]); 
    }

}