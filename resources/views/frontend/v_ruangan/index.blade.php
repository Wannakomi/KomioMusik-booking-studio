@extends('layouts.app')
@section('content') 
<div class="container my-5">
	<h2 class="mb-4 text-warning fw-bold">Daftar Ruangan Studio</h2>
	<div class="row g-4">
		@foreach ($ruangan as $item)
		<div class="col-md-4">
			<div class="ruangan-card card">
				<img src="{{ asset('storage/ruangan/' . $item->foto) }}" alt="{{ $item->nama }}" class="card-img-top img-fit" />
				<div class="card-body">
					<h5 class="card-title">{{ $item->nama }}</h5>
					<p class="card-text">
					@if($item->hargaSewas->count())
						Rp {{ number_format($item->hargaSewas->first()->harga, 0, ',', '.') }} / jam
					@else
						Rp 0 / jam
					@endif
					</p>
					<a href="{{ url('/ruangan/' . $item->id) }}" class="btn btn-warning">Detail</a>
				</div>
			</div>
		</div>
		@endforeach
		</div>
	        @if($ruangan->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {!! $ruangan->links('pagination::bootstrap-5') !!}
        </div>
        @endif
</div>
@endsection