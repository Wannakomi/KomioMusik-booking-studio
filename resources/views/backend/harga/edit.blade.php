@extends('backend.v_layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Edit Harga Sewa</h4>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('backend.harga.update', $hargaSewa->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label>Harga (Rp)</label>
            <input type="number" name="harga" class="form-control" value="{{ old('harga', $hargaSewa->harga) }}" required>
        </div>

        <div class="form-group mb-3">
            <label>Tipe Sewa</label>
            <select name="tipe" class="form-control" required>
                <option value="Latihan" {{ old('tipe', $hargaSewa->tipe) == 'Latihan' ? 'selected' : '' }}>Latihan</option>
                <option value="Rekaman" {{ old('tipe', $hargaSewa->tipe) == 'Rekaman' ? 'selected' : '' }}>Rekaman</option>
                <option value="Podcast" {{ old('tipe', $hargaSewa->tipe) == 'Podcast' ? 'selected' : '' }}>Podcast</option>
            </select>
        </div>

        <div class="form-group mb-4">
            <label>Ruangan (Opsional)</label>
            <select name="ruangan_id" class="form-control">
                <option value="">- Pilih Ruangan -</option>
                @foreach ($ruangan as $r)
                    <option value="{{ $r->id }}" {{ old('ruangan_id', $hargaSewa->ruangan_id) == $r->id ? 'selected' : '' }}>
                        {{ $r->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('backend.harga.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
