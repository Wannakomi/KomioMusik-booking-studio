@extends('backend.v_layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Daftar Jadwal Studio</h4>
    <a href="{{ route('backend.jadwal.create') }}" class="btn btn-primary mb-3">+ Tambah Jadwal</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Ruangan</th>
                <th>Tanggal</th>
                <th>Jam Mulai</th>
                <th>Jam Selesai</th>
                <th>Tersedia</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jadwal as $j)
                <tr>
                    <td>{{ $j->ruangan->nama }}</td>
                    <td>{{ $j->tanggal }}</td>
                    <td>{{ $j->jam_mulai }}</td>
                    <td>{{ $j->jam_selesai }}</td>
                    <td>{{ $j->tersedia ? 'Ya' : 'Tidak' }}</td>
                    <td>
                        <a href="{{ route('backend.jadwal.edit', $j->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('backend.jadwal.destroy', $j->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $jadwal->links() }}
</div>
@endsection
