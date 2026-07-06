@extends('layouts.app')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0" style="background-color: #1a1a1a; color: #fff; border-radius: 20px;">
                <div class="card-body text-center">
                    <img src="{{ asset(Auth::user()->foto ?? 'images/default.png') }}"
                         class="rounded-circle mb-3"
                         width="120" height="120"
                         style="object-fit: cover; border: 3px solid #ffc107;" alt="Foto Profil">

                    <h3 class="mb-1">{{ Auth::user()->nama }}</h3>
                    <p class="text mb-3">{{ Auth::user()->email }}</p>

                    <p><strong>No. HP:</strong> {{ Auth::user()->hp }}</p>

                    <a href="{{ route('frontend.profile.edit') }}" class="btn btn-warning mt-3 px-4">
                        <i class="bi bi-pencil-square"></i> Edit Profil
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection