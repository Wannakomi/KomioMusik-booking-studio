@extends('layouts.app') 

@section('content')
<div class="container py-5" style="max-width: 600px;">
    <h2 class="text-center text-warning mb-4">Daftar Akun</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Lengkap</label>
            <input 
                type="text" 
                name="nama" 
                id="nama" 
                class="form-control" 
                required 
                value="{{ old('nama') }}" 
                placeholder="Masukkan nama lengkap Anda"
            >
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input 
                type="email" 
                name="email" 
                id="email" 
                class="form-control" 
                required 
                value="{{ old('email') }}" 
                placeholder="contoh@email.com"
            >
        </div>

        <div class="mb-3">
            <label for="hp" class="form-label">Nomor HP</label>
            <input 
                type="text" 
                name="hp" 
                id="hp" 
                class="form-control" 
                required 
                value="{{ old('hp') }}" 
                placeholder="08xxxxxxxxxx"
            >
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Kata Sandi</label>
            <input 
                type="password" 
                name="password" 
                id="password" 
                class="form-control" 
                required 
                placeholder="Minimal 6 karakter"
            >
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
            <input 
                type="password" 
                name="password_confirmation" 
                id="password_confirmation" 
                class="form-control" 
                required 
                placeholder="Ulangi kata sandi"
            >
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Daftar Sekarang</button>
        </div>
    </form>
</div>
@endsection
