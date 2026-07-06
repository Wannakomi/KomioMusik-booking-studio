@extends('layouts.app')

@section('content')
<div class="container py-5 text-white">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset('storage/ruangan/' . $ruangan->foto) }}" class="img-fluid rounded shadow" alt="Gambar Ruangan">
        </div>
        <div class="col-md-6">
            <h2 class="fw-bold">{{ $ruangan->nama }}</h2>
            <p class="text">{{ $ruangan->deskripsi }}</p>

            <h4 class="mt-4">Harga Sewa</h4>
            <ul>
                @foreach ($ruangan->hargaSewas as $harga)
                    <li>{{ $harga->keterangan }}: Rp {{ number_format($harga->harga, 0, ',', '.') }} / jam</li>
                @endforeach
            </ul>

            <h2>Fasilitas</h2>
            <ul>
                @foreach($ruangan->fasilitas as $fasilitas)
                    <li>{{ $fasilitas->nama }}</li>
                @endforeach
            </ul>

            <a href="{{ url('/beranda') }}" class="btn btn-secondary mt-4">Kembali</a>
            <!-- <a href="#" class="btn btn-warning mt-4">Booking Sekarang</a> -->
        </div>
    </div>
</div>
@endsection
