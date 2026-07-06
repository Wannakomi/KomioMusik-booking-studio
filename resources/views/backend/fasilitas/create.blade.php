@extends('backend.v_layouts.app')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header text-white" style="background: linear-gradient(to right, #69c0ff, #0050b3);">
            <h5 class="mb-0">
                <i class="fas {{ isset($fasilitas) ? 'fa-edit' : 'fa-plus-circle' }}"></i>
                {{ isset($fasilitas) ? 'Edit Fasilitas' : 'Tambah Fasilitas Baru' }}
            </h5>
            <a href="{{ route('backend.fasilitas.index') }}" class="btn btn-light btn-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            <form action="{{ isset($fasilitas) ? route('backend.fasilitas.update', $fasilitas->id) : route('backend.fasilitas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($fasilitas))
                    @method('PUT')
                @endif

                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Fasilitas <span class="text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control" placeholder="Masukkan nama fasilitas" value="{{ old('nama', $fasilitas->nama ?? '') }}" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="foto" class="form-label">Foto Fasilitas</label>
                        <div class="border p-3 text-center mb-2" style="border-radius: 8px;">
                            @if(isset($fasilitas) && $fasilitas->foto)
                                <img src="{{ asset('storage/fasilitas/' . $fasilitas->foto) }}" alt="Foto Fasilitas" class="img-fluid" id="preview" style="max-height: 200px;">
                            @else
                                <img src="https://via.placeholder.com/200x150?text=Preview+foto+akan+muncul+disini" id="preview" class="img-fluid" style="max-height: 200px;">
                            @endif
                        </div>
                        <input type="file" name="foto" class="form-control" accept="image/jpeg,image/png" onchange="previewImage(event)">
                        <small class="text-muted">Format: JPEG/PNG (Maksimal 2MB)</small>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Data
                    </button>
                    <button type="reset" class="btn btn-outline-secondary">
                        <i class="fas fa-undo"></i> Reset
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function previewImage(event) {
    const preview = document.getElementById('preview');
    const file = event.target.files[0];
    if (file) {
        preview.src = URL.createObjectURL(file);
    }
}
</script>
@endsection
