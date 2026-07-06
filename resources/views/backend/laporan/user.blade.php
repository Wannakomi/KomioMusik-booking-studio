@extends('backend.v_layouts.app')

@section('title', 'Manajemen Review')

@section('content')
<div class="container-fluid">
    <h4 class="mb-4 fw-bold text-dark">Manajemen Review</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm border-0 rounded">
        <div class="card-body table-responsive">
            <table class="table table-striped table-hover align-middle text-center">
                <thead style="background-color: #343a40; color: #ffffff;">
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
                            <td class="text-dark">{{ $review->user->nama }}</td>
                            <td class="text-dark">{{ $review->rating }} / 5</td>
                            <td class="text-start text-dark" style="max-width: 300px;">{{ $review->komentar }}</td>
                            <td class="text-dark">{{ $review->created_at->format('d M Y') }}</td>
                            <td>
                                @if($review->is_hidden)
                                    <span class="badge bg-secondary text-white">Disembunyikan</span>
                                @else
                                    <span class="badge bg-success text-white">Ditampilkan</span>
                                @endif
                            </td>
                            <td class="d-flex gap-1 justify-content-center">
                                <form action="{{ route('backend.review.toggle', $review->id) }}" method="POST" class="me-1">
                                    @csrf @method('PATCH')
                                    <button class="btn btn-sm btn-warning text-white">
                                        {{ $review->is_hidden ? 'Tampilkan' : 'Sembunyikan' }}
                                    </button>
                                </form>
                                <form action="{{ route('backend.review.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Hapus review ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
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
