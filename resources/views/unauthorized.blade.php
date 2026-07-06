<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akses Ditolak - KomioMusik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .error-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            padding: 3rem;
            text-align: center;
            max-width: 600px;
            margin: 0 auto;
        }
        .error-icon {
            font-size: 5rem;
            color: #dc3545;
            margin-bottom: 1rem;
        }
        .error-code {
            font-size: 4rem;
            font-weight: bold;
            color: #dc3545;
            margin-bottom: 1rem;
        }
        .error-title {
            font-size: 2rem;
            color: #333;
            margin-bottom: 1rem;
        }
        .error-message {
            color: #666;
            font-size: 1.1rem;
            margin-bottom: 2rem;
            line-height: 1.6;
        }
        .btn-custom {
            background: linear-gradient(45deg, #667eea, #764ba2);
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            color: white;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
        }
        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            color: white;
        }
        .btn-secondary-custom {
            background: transparent;
            border: 2px solid #667eea;
            color: #667eea;
            margin-left: 10px;
        }
        .btn-secondary-custom:hover {
            background: #667eea;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="error-container">
                    <div class="error-icon">
                        <i class="fas fa-ban"></i>
                    </div>
                    <div class="error-code">403</div>
                    <h1 class="error-title">Akses Ditolak</h1>
                    <p class="error-message">
                        Maaf, Anda tidak memiliki izin untuk mengakses halaman ini. 
                        Silakan hubungi administrator jika Anda merasa ini adalah kesalahan.
                    </p>
                    
                    @if(session('error'))
                        <div class="alert alert-danger" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="mt-4">
                        <a href="{{ route('beranda') }}" class="btn btn-custom">
                            <i class="fas fa-home me-2"></i>
                            Kembali ke Beranda
                        </a>
                        
                        @auth
                            @if(auth()->user()->role == 0.)
                                <a href="{{ route('backend.beranda') }}" class="btn btn-custom btn-secondary-custom">
                                    <i class="fas fa-tachometer-alt me-2"></i>
                                    Dashboard Admin
                                </a>
                            @else
                                <a href="{{ route('profile') }}" class="btn btn-custom btn-secondary-custom">
                                    <i class="fas fa-user me-2"></i>
                                    Profil Saya
                                </a>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn btn-custom btn-secondary-custom">
                                <i class="fas fa-sign-in-alt me-2"></i>
                                Login
                            </a>
                        @endauth
                    </div>

                    <div class="mt-4 text-muted">
                        <small>
                            <i class="fas fa-question-circle me-1"></i>
                            Butuh bantuan? Hubungi administrator sistem.
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>