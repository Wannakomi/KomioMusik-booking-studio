@extends('backend.v_layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Daftar Harga Sewa</h4>
    <a href="{{ route('backend.harga.create') }}" class="btn btn-primary mb-3">+ Tambah Harga Sewa</a>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Harga</th>
                    <th>Tipe</th>
                    <th>Ruangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($hargaSewa as $item)
                <tr>
                    <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                    <td>{{ $item->tipe }}</td>
                    <td>{{ $item->ruangan->nama ?? '-' }}</td>
                    <td>
                        <a href="{{ route('backend.harga.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('backend.harga.destroy', $item->id) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Belum ada data harga sewa</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{-- Pagination --}}
        <div class="d-flex justify-content-center mt-3">
            {{ $hargaSewa->links() }}
        </div>
    </div>
</div>
@endsection
