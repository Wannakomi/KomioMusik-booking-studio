@extends('backend.v_layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Jam Operasional</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('backend.jam_operasional.create') }}" class="btn btn-primary mb-3">+ Tambah</a>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Hari</th>
                <th>Jam Buka</th>
                <th>Jam Tutup</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->hari }}</td>
                <td>{{ \Carbon\Carbon::parse($item->jam_buka)->format('H:i') }}</td>
                <td>{{ \Carbon\Carbon::parse($item->jam_tutup)->format('H:i') }}</td>
                <td>{{ $item->status }}</td>
                <td>
                    <a href="{{ route('backend.jam_operasional.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('backend.jam_operasional.destroy', $item->id) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Belum ada data.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
