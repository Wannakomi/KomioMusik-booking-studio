@extends('layouts.app')
@section('content') 
<div class="container my-5">
	<h2 class="mb-4 text-warning fw-bold">Daftar Ruangan Studio</h2>
	<div class="row g-4">
		@foreach ($ruangan as $item)
		<div class="col-md-4">
			<div class="ruangan-card card">
				<div class="zoom-hover" style="height: 220px; overflow: hidden;">
					<img src="{{ asset('storage/ruangan/' . $item->foto) }}"
						alt="{{ $item->nama }}"
						class="card-img-top w-100"
						style="object-fit: cover; height: 100%;">
				</div>
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
</div>

{{-- ... Daftar Ruangan --}}
</div>
</div>
{{-- Form Review --}}
@auth
<div class="container my-5">
    <div class="card shadow-sm border-0 bg-dark text-white">
        <div class="card-header bg-warning text-dark fw-bold d-flex align-items-center">
            <i class="fas fa-star me-2"></i> Kasih Rating Ya Cuy
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('review.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="rating" class="form-label">Rating (1-5)</label>
                    <select name="rating" id="rating" class="form-select rounded-3" required>
                        @for($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <div class="mb-3">
                    <label for="komentar" class="form-label">Komentar</label>
                    <textarea name="komentar" id="komentar" class="form-control rounded-3" rows="4" placeholder="Tulis pendapat kamu..." required></textarea>
                </div>

                <button class="btn btn-primary rounded-pill px-4">
                    <i class="fas fa-paper-plane me-1"></i> Kirim Review
                </button>
            </form>
        </div>
    </div>
</div>
@else
    <div class="container my-5">
        <div class="alert alert-warning text-center">
            <i class="fas fa-sign-in-alt me-2"></i>Login dulu untuk memberikan review.
        </div>
    </div>
@endauth


{{-- Review Section --}}
<div class="container my-5">
    <h4 class="mb-4 fw-bold text-primary">🗣️ Review Pengguna</h4>

    {{-- Tampilkan review --}}
    @forelse ($reviews as $review)
        <div class="card mb-3 shadow-sm border-0 bg-light">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div>
                        <strong class="text-dark">{{ $review->user->nama }}</strong>
                        <div class="text-warning">
                            @for ($i = 1; $i <= 5; $i++)
                                @if($i <= $review->rating)
                                    <i class="fas fa-star"></i>
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                            @endfor
                            <small class="text-muted ms-2">({{ $review->rating }}/5)</small>
                        </div>
                    </div>
                    <small class="text-muted">{{ $review->created_at->format('d M Y') }}</small>
                </div>

                <p class="mb-2 text-dark">{{ $review->komentar }}</p>

                @if (Auth::check() && Auth::id() === $review->user_id)
                    <form action="{{ route('review.delete', $review->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus review ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                    </form>
                @endif
            </div>
        </div>
    @empty
        <div class="alert alert-info text-center">Belum ada review dari pengguna.</div>
    @endforelse
</div>

@endsection