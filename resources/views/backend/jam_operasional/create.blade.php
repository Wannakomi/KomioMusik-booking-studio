@extends('backend.v_layouts.app')

@section('title', 'Tambah Jam Operasional')

@section('content')
<div class="container-fluid">
    <h4 class="mb-4">Tambah Jam Operasional</h4>
    
    <form action="{{ route('backend.jam_operasional.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label>Hari</label>
            <input type="text" name="hari" class="form-control" required placeholder="Contoh: Senin - Jumat">
        </div>
        <div class="form-group mb-3">
            <label>Jam Buka</label>
            <input type="time" name="jam_buka" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label>Jam Tutup</label>
            <input type="time" name="jam_tutup" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="Aktif" {{ old('status', $jamOperasional->status ?? '') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="Nonaktif" {{ old('status', $jamOperasional->status ?? '') == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('backend.jam_operasional.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
