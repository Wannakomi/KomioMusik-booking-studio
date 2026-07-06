<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="images/png" sizes="16x16" href="{{ asset('backend/images/komisangitar.png') }}"> 
    <title>KomioMusik</title>
    <link rel="stylesheet" href="{{ asset('backend/libs/bootstrap/dist/css/bootstrap.min.css') }}">
    <style>
        body {
            background-color:rgba(54, 96, 132, 0.46);
            color: #fff;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-card {
            background-color:rgb(45, 31, 120);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(1, 7, 17, 0.64);
            width: 100%;
            max-width: 400px;
        }

        .login-card h3 {
            margin-bottom: 30px;
            font-weight: bold;
            text-align: center;
            color: #fff;
        }

        .form-control {
            background-color:rgba(71, 110, 160, 0.66);
            border: none;
            color: #fff;
        }

        .form-control:focus {
            background-color:rgb(92, 58, 58);
            border-color: #5cb85c;
            color: #fff;
        }

        .btn-custom {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border-radius: 10px;
        }

        .text-link {
            display: block;
            text-align: right;
            color: #ccc;
            font-size: 0.9rem;
            margin-top: 10px;
        }

        .text-link:hover {
            color: #fff;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <h3>KomioMusik</h3>
        @if(session()->has('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <form method="POST" action="{{ route('backend.login') }}">
            @csrf
            <div class="form-group">
                <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                @error('email')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                @error('password')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <button type="submit" class="btn btn-success btn-custom">Login</button>
        </form>
    </div>

    <script src="{{ asset('backend/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
