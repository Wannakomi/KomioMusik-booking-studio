@extends('layouts.app')

@section('content')
<div class="container py-5 text-white">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0" style="background-color: #1e1e1e; border-radius: 20px;">
                <div class="card-body">
                    <h3 class="mb-4 text-center text-white">Edit Profil</h3>
                    <form action="{{ route('frontend.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3 text-center">
                            @if(Auth::user()->foto)
                                <img id="img-preview" src="{{ asset(Auth::user()->foto) }}" 
                                     alt="Foto Profil" 
                                     class="rounded-circle mb-2"
                                     width="100" height="100"
                                     style="object-fit: cover;">
                            @else
                                <img id="img-preview" src="https://via.placeholder.com/100" 
                                     alt="Foto Profil" 
                                     class="rounded-circle mb-2"
                                     width="100" height="100"
                                     style="object-fit: cover;">
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="foto" class="form-label text-white">Foto Profil</label>
                            <input type="file" name="foto" id="foto" class="form-control bg-dark text-white border-secondary">
                        </div>
                        
                        <div class="mb-3">
                            <label for="nama" class="form-label text-white">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control bg-dark text-white border-secondary"
                                   value="{{ old('nama', Auth::user()->nama) }}">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label text-white">Email</label>
                            <input type="email" name="email" id="email" class="form-control bg-dark text-white border-secondary"
                                   value="{{ old('email', Auth::user()->email) }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="hp" class="form-label text-white">No. HP</label>
                            <input type="text" name="hp" id="hp" class="form-control bg-dark text-white border-secondary"
                                   value="{{ old('hp', Auth::user()->hp) }}">
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-warning px-4 slider-btn">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

