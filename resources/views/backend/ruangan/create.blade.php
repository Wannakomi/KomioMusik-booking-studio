@extends('backend.v_layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header text-white" style="background: linear-gradient(to right, #69c0ff, #0050b3);">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">
                    <i class="fas fa-plus-circle mr-2"></i>Tambah Ruangan Baru
                </h4>
                <a href="{{ route('backend.ruangan.index') }}" class="btn btn-light btn-sm">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('backend.ruangan.store') }}" method="POST" enctype="multipart/form-data" id="ruanganForm">
                @csrf
                
                <div class="row">
                    <!-- Left Column - Form Fields -->
                    <div class="col-md-8">
                        <div class="form-group mb-4">
                            <label class="form-label font-weight-bold">Nama Ruangan <span class="text-danger">*</span></label>
                            <input type="text" name="nama" 
                                   class="form-control @error('nama') is-invalid @enderror" 
                                   value="{{ old('nama') }}" 
                                   placeholder="Masukkan nama ruangan"
                                   required>
                            @error('nama')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-4">
                            <label class="form-label font-weight-bold">Deskripsi</label>
                            <textarea name="deskripsi" 
                                      class="form-control @error('deskripsi') is-invalid @enderror" 
                                      rows="5"
                                      placeholder="Masukkan deskripsi ruangan">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Right Column - Photo Upload -->
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">
                                    <i class="fas fa-image mr-2"></i>Foto Ruangan
                                </h5>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <div class="text-center mb-3 flex-grow-1 d-flex align-items-center justify-content-center">
                                    <div style="width: 100%">
                                        <img id="fotoPreview" 
                                             class="img-thumbnail mx-auto d-block" 
                                             style="max-width: 100%; max-height: 200px; display: none;">
                                        <div id="emptyPhoto" class="p-4 border rounded bg-light">
                                            <i class="fas fa-camera fa-3x text-muted mb-2"></i>
                                            <p class="mb-0 text-muted">Preview foto akan muncul disini</p>
                                        </div>  
                                    </div>
                                </div>
                                
                                <div class="form-group mt-auto">
                                    <div class="custom-file">
                                        <input type="file" 
                                               name="foto" 
                                               id="fotoInput"
                                               class="custom-file-input @error('foto') is-invalid @enderror"
                                               accept="image/jpeg, image/png">
                                        <label class="custom-file-label" for="fotoInput">Pilih file...</label>
                                    </div>
                                    @error('foto')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">
                                        Format: JPEG/PNG (Maksimal 2MB)
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group mt-4 pt-3 border-top">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save mr-1"></i> Simpan Data
                    </button>
                    <button type="reset" class="btn btn-outline-secondary ml-2">
                        <i class="fas fa-undo mr-1"></i> Reset
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fotoInput = document.getElementById('fotoInput');
        const fotoPreview = document.getElementById('fotoPreview');
        const emptyPhoto = document.getElementById('emptyPhoto');
        const fileLabel = fotoInput.nextElementSibling;
        
        // File input change handler
        fotoInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            
            if (file) {
                // Update file label
                fileLabel.textContent = file.name;
                
                // Validate file size (2MB max)
                if (file.size > 2 * 1024 * 1024) {
                    alert('Ukuran file maksimal 2MB');
                    this.value = '';
                    return;
                }
                
                // Show preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    fotoPreview.src = e.target.result;
                    fotoPreview.style.display = 'block';
                    emptyPhoto.style.display = 'none';
                }
                reader.readAsDataURL(file);
            } else {
                // Reset preview if no file selected
                fileLabel.textContent = 'Pilih file...';
                    fotoPreview.style.display = 'none';
                    emptyPhoto.style.display = 'block';
                }
            });
            
            // Form validation
            document.getElementById('ruanganForm').addEventListener('submit', function(e) {
                const namaField = document.querySelector('input[name="nama"]');
                if (!namaField.value.trim()) {
                    e.preventDefault();
                    alert('Nama ruangan harus diisi');
                    namaField.focus();
                }
            });
        });
    </script>

    <style>
        .custom-file-input ~ .custom-file-label::after {
            content: "Pilih";
        }
        .img-thumbnail {
            object-fit: contain;
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
            background-color: #fff;
        }
        .card-header {
            border-radius: 0.35rem 0.35rem 0 0 !important;
        }
        #emptyPhoto {
            min-height: 150px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .card.h-100 {
            height: 100% !important;
        }
        .d-flex.align-items-center.justify-content-center {
            min-height: 200px;
        }
    </style>
@endsection