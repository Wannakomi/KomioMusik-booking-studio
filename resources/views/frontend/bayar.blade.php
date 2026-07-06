@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Bayar Booking</h2>

    <p><strong>Kode Booking:</strong> {{ $booking->kode_booking }}</p>
    <p><strong>Nama Pemesan:</strong> {{ $booking->nama_pemesan }}</p>
    <p><strong>Tanggal:</strong> {{ $booking->tanggal }}</p>
    <p><strong>Total Pembayaran:</strong> Rp {{ number_format($booking->total_pembayaran, 0, ',', '.') }}</p>

    <form action="{{ route('bayar.upload', $booking->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="bukti_pembayaran" class="form-label">Upload Bukti Pembayaran</label>
            <input type="file" class="form-control" id="bukti_pembayaran" name="bukti_pembayaran" required>
        </div>
        <button type="submit" class="btn btn-success">Kirim Pembayaran</button>
    </form>
</div>
@endsection
