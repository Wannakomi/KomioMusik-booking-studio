@extends('backend.v_layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Tambah Jadwal Studio</h4>
    <form action="{{ route('backend.jadwal.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Ruangan</label>
            <select name="ruangan_id" class="form-control" required>
                <option value="">-- Pilih Ruangan --</option>
                @foreach($ruangan as $r)
                    <option value="{{ $r->id }}">{{ $r->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Jam Mulai</label>
            <input type="time" name="jam_mulai" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Jam Selesai</label>
            <input type="time" name="jam_selesai" class="form-control" required>
        </div>

        <div class="form-check mb-3">
            <input type="hidden" name="tersedia" value="0">
            <input class="form-check-input" type="checkbox" name="tersedia" value="1" checked>
            <label class="form-check-label">Tersedia</label>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('backend.jadwal.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
