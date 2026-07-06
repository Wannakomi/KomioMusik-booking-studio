@extends('backend.v_layouts.app')

@section('title', 'Hasil Laporan Transaksi')

@section('content')
<div class="container-fluid">
    <h4 class="mb-4">Laporan Transaksi: {{ $tanggal_awal }} s.d. {{ $tanggal_akhir }}</h4>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode Booking</th>
                <th>Nama Pemesan</th>
                <th>Tanggal Booking</th>
                <th>Total Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pembayaran as $data)
            <tr>
                <td>{{ $data->kode_booking }}</td>
                <td>{{ $data->nama_pemesan }}</td>
                <td>{{ $data->tanggal_booking }}</td>
                <td>Rp {{ number_format($data->total_pembayaran) }}</td>
            </tr>
            @empty
            <tr><td colspan="4" class="text-center">Tidak ada data.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
