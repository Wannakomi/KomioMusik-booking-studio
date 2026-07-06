@extends('backend.v_layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header text-white" style="background: linear-gradient(to right, #69c0ff, #0050b3);">
            <h4 class="mb-0">Daftar Fasilitas Studio</h4>
        </div>
        
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                </div>
            @endif

            <div class="d-flex justify-content-between mb-4">
                <div class="search-box">
                    <input type="text" class="form-control" placeholder="Cari fasilitas..." id="search-input">
                </div>
                <a href="{{ route('backend.fasilitas.create') }}" class="card-header text-white" style="background: linear-gradient(to right, #69c0ff, #0050b3);">
                    <i class="fas fa-plus me-2"></i>Tambah Fasilitas
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-bordered" id="fasilitas-table">
                    <thead class="table-light">
                        <tr>
                            <th width="120" class="text-center">Foto</th>
                            <th>Nama Fasilitas</th>
                            <th width="120" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($fasilitas as $item)
                        <tr>
                            <td class="text-center">
                                @if($item->foto)
                                    <img src="{{ asset('storage/fasilitas/' . $item->foto) }}" 
                                         alt="{{ $item->nama }}"
                                         class="img-thumbnail rounded-circle"
                                         style="width: 80px; height: 80px; object-fit: cover;">
                                @else
                                    <div class="d-flex align-items-center justify-content-center bg-light rounded-circle" 
                                         style="width: 80px; height: 80px;">
                                        <i class="fas fa-image text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="align-middle">{{ $item->nama }}</td>
                            <td class="text-center align-middle">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('backend.fasilitas.edit', $item->id) }}" 
                                       class="btn btn-sm btn-outline-primary"
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('backend.fasilitas.destroy', $item->id) }}" 
                                          method="POST" 
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-outline-danger"
                                                title="Hapus"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus fasilitas ini?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fas fa-inbox fa-2x mb-2"></i>
                                    <p>Belum ada fasilitas yang ditambahkan</p>
                                    <a href="{{ route('backend.fasilitas.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus me-2"></i>Tambah Fasilitas
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($fasilitas->hasPages())
            <div class="d-flex justify-content-center mt-4">
                <nav aria-label="Page navigation">
                    {{ $fasilitas->links('vendor.pagination.bootstrap-5') }}
                </nav>
            </div>
            @endif
        </div>
    </div>
</div>

@section('scripts')
<script>
    // Search functionality
    document.getElementById('search-input').addEventListener('keyup', function() {
        const searchValue = this.value.toLowerCase();
        const rows = document.querySelectorAll('#fasilitas-table tbody tr');
        
        rows.forEach(row => {
            const nama = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            
            if (nama.includes(searchValue) ) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>
@endsection
@endsection
