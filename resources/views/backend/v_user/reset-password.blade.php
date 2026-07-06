@extends('backend.v_layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <a href="{{ route('backend.user.index') }}" class="btn btn-secondary mb-3">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Reset Password untuk: {{ $user->nama }}</h5>

                <form action="{{ route('backend.user.reset-password', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>Password Baru</label>
                        <input type="password" name="password" class="form-control" required>
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-key"></i> Reset Password
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
