@extends('backend.v_layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Tambah Harga Sewa</h4>
    <form action="{{ route('backend.harga.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Harga (Rp)</label>
            <input type="number" name="harga" class="form-control" value="{{ old('harga') }}" required>
        </div>

        <div class="form-group">
            <label>Tipe Sewa</label>
            <select name="tipe" class="form-control" required>
                <option value="Latihan" {{ old('tipe') == 'Latihan' ? 'selected' : '' }}>Latihan</option>
                <option value="Rekaman" {{ old('tipe') == 'Rekaman' ? 'selected' : '' }}>Rekaman</option>
                <option value="Podcast" {{ old('tipe') == 'Podcast' ? 'selected' : '' }}>Podcast</option>
            </select>
        </div>

        <div class="form-group">
            <label>Ruangan (Opsional)</label>
            <select name="ruangan_id" class="form-control">
                <option value="">- Pilih Ruangan -</option>
                @foreach ($ruangan as $ruangan)
                <option value="{{ $ruangan->id }}" {{ old('ruangan_id') == $ruangan->id ? 'selected' : '' }}>
                    {{ $ruangan->nama }}
                </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('backend.harga.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
