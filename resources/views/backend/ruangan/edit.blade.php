@extends('backend.v_layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header text-white" style="background: linear-gradient(to right, #69c0ff, #0050b3);">
            <h4 class="card-title mb-0">
                <i class="fas fa-edit mr-2"></i>Edit Ruangan
            </h4>
        </div>
        <div class="card-body">
            <form action="{{ route('backend.ruangan.update', $ruangan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Ruangan <span class="text-danger">*</span></label>
                            <input type="text" name="nama" 
                                   class="form-control @error('nama') is-invalid @enderror" 
                                   value="{{ old('nama', $ruangan->nama) }}" 
                                   placeholder="Masukkan nama ruangan" required>
                            @error('nama')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Deskripsi</label>
                            <textarea name="deskripsi" 
                                      class="form-control @error('deskripsi') is-invalid @enderror" 
                                      rows="5"
                                      placeholder="Masukkan deskripsi ruangan">{{ old('deskripsi', $ruangan->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Right Column -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header bg-light">
                                <h5 class="card-title mb-0">Foto Ruangan</h5>
                            </div>
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    @if($ruangan->foto)
                                        <img id="currentFoto" 
                                             src="{{ asset('storage/ruangan/' . $ruangan->foto) }}" 
                                             class="img-thumbnail w-100 mb-3"
                                             style="max-height: 200px; object-fit: contain;">
                                    @else
                                        <div class="bg-light p-4 text-center mb-3">
                                            <i class="fas fa-image fa-3x text-muted mb-2"></i>
                                            <p class="mb-0 text-muted">Tidak ada foto</p>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file" 
                                               name="foto" 
                                               id="fotoInput"
                                               class="custom-file-input @error('foto') is-invalid @enderror"
                                               accept="image/*">
                                        <label class="custom-file-label" for="fotoInput">Pilih file...</label>
                                    </div>
                                    @error('foto')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">
                                        Format: JPG, PNG (Max 2MB). Kosongkan jika tidak ingin mengubah.
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('backend.ruangan.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // File input label update
        const fotoInput = document.getElementById('fotoInput');
        const fileLabel = fotoInput.nextElementSibling;
        
        fotoInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                fileLabel.textContent = this.files[0].name;
                
                // Image preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    let imgPreview = document.getElementById('currentFoto');
                    
                    if (!imgPreview) {
                        // Create new preview if doesn't exist
                        const previewContainer = fotoInput.closest('.card-body').querySelector('.mb-3');
                        previewContainer.innerHTML = '';
                        imgPreview = document.createElement('img');
                        imgPreview.id = 'currentFoto';
                        imgPreview.className = 'img-thumbnail w-100 mb-3';
                        imgPreview.style.maxHeight = '200px';
                        imgPreview.style.objectFit = 'contain';
                        previewContainer.appendChild(imgPreview);
                    }
                    
                    imgPreview.src = e.target.result;
                }
                reader.readAsDataURL(this.files[0]);
            } else {
                fileLabel.textContent = 'Pilih file...';
            }
        });
    });
</script>

<style>
    .custom-file-input ~ .custom-file-label::after {
        content: "Browse";
    }
    .img-thumbnail {
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
        padding: 0.25rem;
        background-color: #fff;
    }
    .card-header {
        border-radius: 0.35rem 0.35rem 0 0 !important;
    }
</style>
@endsection