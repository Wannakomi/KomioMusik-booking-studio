@extends('backend.v_layouts.app')

@section('title', 'Laporan Keuangan')

@section('content')
<div class="container-fluid">
    <h4 class="mb-4">Laporan Keuangan</h4>

    <div class="card">
        <div class="card-body">
            <h5>Total Pemasukan:</h5>
            <h3 class="text-success">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</h3>
        </div>
    </div>
</div>
@endsection
