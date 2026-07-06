@extends('backend.v_layouts.app')

@section('title', 'Manajemen Review')

@section('content')
<div class="container-fluid">
    <h4 class="mb-4 fw-bold text-dark">📋 Manajemen Review</h4>

    @if(session('success'))
        <div class="alert alert-success shadow-sm rounded">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm border-0 rounded">
        <div class="card-body table-responsive">
            <table class="table table-hover align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>User</th>
                        <th>Rating</th>
                        <th>Pesan</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reviews as $review)
                        <tr>
                            <td class="text-start">{{ $review->user->nama }}</td>
                            <td>
                                <span class="badge bg-warning text-dark">
                                    ⭐ {{ $review->rating }} / 5
                                </span>
                            </td>
                            <td class="text-start">{{ Str::limit($review->komentar, 80) }}</td>
                            <td>{{ $review->created_at->format('d M Y') }}</td>
                            <td>
                                @if($review->is_hidden)
                                    <span class="badge bg-secondary">Disembunyikan</span>
                                @else
                                    <span class="badge bg-success">Ditampilkan</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-1">
                                    <form action="{{ route('backend.review.toggle', $review->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <button class="btn btn-sm btn-outline-warning shadow-sm">
                                            {{ $review->is_hidden ? 'Tampilkan' : 'Sembunyikan' }}
                                        </button>
                                    </form>
                                    <form action="{{ route('backend.review.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Hapus review ini?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger shadow-sm">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Belum ada review.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
