@extends('backend.v_layouts.app')

@section('title', 'Laporan Transaksi')

@section('content')
<div class="container-fluid">
    <h4 class="mb-4">Laporan Transaksi per Periode</h4>
    <form action="{{ route('backend.laporan.transaksi') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="tanggal_awal" class="form-label">Tanggal Awal</label>
                <input type="date" name="tanggal_awal" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
                <input type="date" name="tanggal_akhir" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3 align-self-end">
                <button type="submit" class="btn btn-primary">Lihat Laporan</button>
            </div>
        </div>
    </form>
</div>
@endsection
