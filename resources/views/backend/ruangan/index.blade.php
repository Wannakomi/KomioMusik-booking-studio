@extends('backend.v_layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4 mb-0 text-gray-800">Daftar Ruangan</h1>
        <a href="{{ route('backend.ruangan.create') }}" class="card-header text-white" style="background: linear-gradient(to right, #69c0ff, #0050b3);">
            <i class="fas fa-plus mr-1"></i> Tambah Ruangan
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Room Table -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th width="120">Foto</th>
                            <th>Nama Ruangan</th>
                            <th>Deskripsi</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ruangan as $item)
                        <tr>
                            <td class="text-center">
                                @if($item->foto)
                                    <img src="{{ asset('storage/app/public/storage/ruangan/' . $item->foto) }}" 
                                        class="img-thumbnail rounded-circle"
                                        alt="Foto {{ $item->nama }}"
                                        style="width: 80px; height: 80px; object-fit: cover;">
                                @else
                                    <div class="text-center text-muted py-3 bg-light">
                                        <i class="fas fa-image fa-2x"></i>
                                        <p class="small mb-0">No Image</p>
                                    </div>
                                @endif
                            </td>
                            <td>{{ $item->nama }}</td>
                            <td style="max-width: 400px;">{{ $item->deskripsi }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('backend.ruangan.edit', $item->id) }}" 
                                        class="btn btn-sm btn-outline-primary mr-1"
                                        title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('backend.ruangan.destroy', $item->id) }}" 
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus ruangan ini?')"
                                                title="Hapus">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4">Tidak ada data ruangan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($ruangan->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {!! $ruangan->links('pagination::bootstrap-4') !!}
            </div>
            @endif
        </div>
    </div>
</div>

<style>
    .pagination {
        margin-bottom: 0;
    }
    /* Hanya kolom aksi yang tidak wrap */
    th:last-child, td:last-child {
        white-space: nowrap;
    }
    .img-thumbnail {
        padding: 0.25rem;
    }
</style>
@endsection
