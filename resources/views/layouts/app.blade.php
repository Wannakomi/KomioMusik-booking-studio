<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="KomioMusik - Premium Music Studio Booking Platform">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('backend/images/komisangitar.png') }}">
    <title>KomioMusik - Premium Music Studios CIHUY</title>
    
    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_blue.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #FF9F1C;
            --primary-dark: #FF8811;
            --dark-bg: #121212;
            --card-bg: #1E1E1E;
            --text-light: #F5F5F5;
            --text-muted: #AAAAAA;
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        
        body {
            background-color: var(--dark-bg);
            color: var(--text-light);
            font-family: 'Poppins', sans-serif;
            scroll-behavior: smooth;
            line-height: 1.6;
        }
        
        /* Navigation */
        .navbar-custom {
            background-color: rgba(28, 28, 28, 0.95);
            padding: 0.75rem 1.5rem;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 159, 28, 0.1);
            transition: var(--transition);
        }
        
        .navbar-custom.scrolled {
            background-color: rgba(28, 28, 28, 0.98);
            box-shadow: 0 4px 12px rgba(255, 159, 28, 0.1);
        }
        
        .navbar-brand {
            font-weight: 700;
            color: var(--primary-color) !important;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
        }
        
        .navbar-brand::before {
            /* content: "🎸"; */
            margin-right: 8px;
            font-size: 1.2em;
        }
        
        .navbar-toggler {
            border: none;
            padding: 0.5rem;
        }
        
        .navbar-toggler:focus {
            box-shadow: none;
        }
        
        .navbar-toggler-icon-custom {
            color: var(--primary-color);
            font-size: 1.5rem;
        }
        
        .nav-link {
            color: var(--text-light);
            font-weight: 500;
            padding: 0.5rem 1rem;
            margin: 0 0.25rem;
            border-radius: 4px;
            transition: var(--transition);
        }
        
        .nav-link:hover, .nav-link:focus {
            color: var(--primary-color);
            background-color: rgba(255, 159, 28, 0.1);
        }
        
        .nav-link.active {
            color: var(--primary-color);
            font-weight: 600;
        }
        
        .btn-booking {
            background-color: var(--primary-color);
            color: #121212;
            font-weight: 600;
            border-radius: 6px;
            padding: 0.5rem 1.25rem;
            transition: var(--transition);
            margin-left: 0.5rem;
        }
        
        .btn-booking:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(255, 159, 28, 0.3);
        }
        
        /* User dropdown */
        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid rgba(255, 159, 28, 0.3);
        }
        
        .dropdown-menu {
            background-color: var(--card-bg);
            border: none;
            border-radius: 8px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
            padding: 0.5rem 0;
            margin-top: 0.5rem;
        }
        
        .dropdown-item {
            color: var(--text-light);
            padding: 0.5rem 1.5rem;
            transition: var(--transition);
        }
        
        .dropdown-item:hover {
            background-color: rgba(255, 159, 28, 0.1);
            color: var(--primary-color);
        }
        
        .dropdown-divider {
            border-color: rgba(255, 255, 255, 0.05);
        }
        
        /* Hero Carousel */
        .hero-carousel {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
        }
        
        .carousel-item {
            height: 60vh;
            min-height: 400px;
        }
        
        .carousel-item img {
            object-fit: cover;
            height: 100%;
            width: 100%;
        }
        
        .carousel-caption {
            bottom: 25%;
            text-align: left;
            left: 10%;
            right: auto;
            max-width: 500px;
            background-color: rgba(28, 28, 28, 0.7);
            padding: 2rem;
            border-radius: 8px;
            backdrop-filter: blur(5px);
        }
        
        .carousel-caption h3 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--primary-color);
        }
        
        .carousel-caption p {
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
        }
        
        .carousel-btn {
            background-color: var(--primary-color);
            color: #121212;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            border-radius: 6px;
            text-decoration: none;
            transition: var(--transition);
        }
        
        .carousel-btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 159, 28, 0.4);
        }
        
        .carousel-control-prev, .carousel-control-next {
            width: 5%;
        }
        
        .carousel-control-prev-icon, .carousel-control-next-icon {
            background-color: rgba(28, 28, 28, 0.7);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            background-size: 1.5rem;
            backdrop-filter: blur(5px);
        }
        
        /* Footer */
        footer {
            background-color: #1c1c1c;
            color: var(--text-light);
            padding: 3rem 0 1.5rem;
            margin-top: 4rem;
        }
        
        .footer-logo {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1rem;
            display: inline-block;
        }
        
        .footer-links h5 {
            color: var(--primary-color);
            font-size: 1.1rem;
            margin-bottom: 1.25rem;
            font-weight: 600;
        }
        
        .footer-links ul {
            list-style: none;
            padding-left: 0;
        }
        
        .footer-links li {
            margin-bottom: 0.75rem;
        }
        
        .footer-links a {
            color: var(--text-muted);	
            text-decoration: none;
            transition: var(--transition);
        }
        
        .footer-links a:hover {
            color: var(--primary-color);
            padding-left: 5px;
        }
        
        .social-icons {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }
        
        .social-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.05);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
            color: var(--text-muted);
        }
        
        .social-icon:hover {
            background-color: var(--primary-color);
            color: #121212;
            transform: translateY(-3px);
        }
        
        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            padding-top: 1.5rem;
            margin-top: 2rem;
            color: var(--text-muted);
            font-size: 0.9rem;
        }
        
		/* Audio Player */
		.audio-player-container {
			background-color: var(--card-bg);
			border-radius: 12px;
			padding: 1.5rem;
			box-shadow: 0 6px 18px rgba(255, 255, 255, 0.1);
			text-align: center;
			transition: transform 0.2s ease;
		}

		.audio-player-container:hover {
			transform: scale(1.02);
		}

		.audio-player-container h5 {
			color: var(--primary-color);
			margin-bottom: 1rem;
			font-weight: 600;
		}

		audio {
			width: 100%;
			border-radius: 12px;
			outline: none;
			filter: brightness(1.5) contrast(1.2);
		}

		/* Warna background kontrol player (Chrome/Safari) */
		audio::-webkit-media-controls-panel {
			background-color: rgb(158, 133, 65);
			border-radius: 12px;
		}

        
        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .navbar-collapse {
                padding: 1rem 0;
            }
            
            .nav-item {
                margin: 0.25rem 0;
            }
            
            .btn-booking {
                margin: 0.5rem 0 0 0;
                width: 100%;
            }
            
            .carousel-item {
                height: 50vh;
            }
            
            .carousel-caption {
                bottom: 15%;
                left: 5%;
                right: 5%;
                max-width: 90%;
                padding: 1.5rem;
            }
            
            .carousel-caption h3 {
                font-size: 1.8rem;
            }
        }
        
        @media (max-width: 768px) {
            .carousel-item {
                height: 40vh;
            }
            
            .carousel-caption {
                padding: 1rem;
            }
            
            .carousel-caption h3 {
                font-size: 1.5rem;
                margin-bottom: 0.5rem;
            }
            
            .carousel-caption p {
                font-size: 0.9rem;
                margin-bottom: 1rem;
            }
            
            .carousel-btn {
                padding: 0.5rem 1rem;
                font-size: 0.9rem;
            }
            
            .footer-links {
                margin-bottom: 2rem;
            }
        }
        
        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animate-fade {
            animation: fadeIn 0.6s ease-out forwards;
        }
        
        /* Utility Classes */
        .text-primary-custom {
            color: var(--primary-color);
        }
        
        .bg-card {
            background-color: var(--card-bg);
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
        
        .hover-scale {
            transition: var(--transition);
        }
        
        .hover-scale:hover {
            transform: scale(1.03);
        }
        
        .section-padding {
            padding: 4rem 0;
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand">KomioMusik</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars navbar-toggler-icon-custom"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('ruangan') ? 'active' : '' }}" href="{{ url('/ruangan') }}">Ruangan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('lokasi') ? 'active' : '' }}" href="{{ url('/lokasi') }}">Lokasi</a>
                    </li>
                    @auth
                        @if(auth()->user()->role == 1)
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('booking/user') ? 'active' : '' }}" href="{{ route('booking.user.index') }}">Booking Saya</a>
                            </li>
                        @endif
                    @endauth
                </ul>
                
                <ul class="navbar-nav ms-auto">
                    @auth
                        @if(auth()->user()->role == 1)
                            <li class="nav-item d-none d-lg-block">
                                <a href="{{ route('booking.user.create') }}" class="btn btn-booking">
                                    <i class="fas fa-calendar-plus me-2"></i>Booking Studio
                                </a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="btn btn-booking">
                                <i class="fas fa-sign-in-alt me-2"></i>Login untuk Booking
                            </a>
                        </li>
                    @endauth
                    
                    <li class="nav-item dropdown ms-lg-3">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            @auth
                                @if(Auth::user()->foto)
                                    <img src="{{ asset(Auth::user()->foto) }}" alt="Profile" class="user-avatar me-2">
                                @else
                                    <i class="fas fa-user-circle me-2" style="font-size: 1.75rem; color: var(--primary-color);"></i>
                                @endif
                                <span class="d-none d-lg-inline">{{ Auth::user()->nama }}</span>
                            @else
                                <i class="fas fa-user-circle" style="font-size: 1.75rem; color: var(--primary-color);"></i>
                            @endauth
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="accountDropdown">
                            @auth
                                <li><a class="dropdown-item" href="{{ route('profile') }}"><i class="fas fa-user-circle me-2"></i>Profil</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
                                    </form>
                                </li>
                            @else
                                <li><a class="dropdown-item" href="{{ route('login') }}"><i class="fas fa-sign-in-alt me-2"></i>Login</a></li>
                                <li><a class="dropdown-item" href="{{ route('register') }}"><i class="fas fa-user-plus me-2"></i>Register</a></li>
                            @endauth
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container section-padding">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <a href="{{ url('/') }}" class="footer-logo">KomioMusik</a>
                    <p class="text">Platform booking studio musik profesional dengan fasilitas terbaik dan harga murah.</p>
                    <div class="social-icons">
                        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.instagram.com/wannafarid_" target="_blank" class="social-icon"><i class="fab fa-instagram"></i></a>
                        <a href="https://youtube.com/shorts/fSiiXc7g2-0" target="_blank" class="social-icon"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-6 mb-4">
                    <div class="footer-links">
                        <h5>Menu</h5>
                        <ul>
                            <li><a href="{{ url('/') }}">Beranda</a></li>
                            <li><a href="{{ url('/ruangan') }}">Ruangan</a></li>
                            <li><a href="{{ url('/lokasi') }}">Lokasi</a></li>
                            <li><a href="{{ route('booking.user.create') }}">Booking</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="footer-links">
                        <h5>Layanan</h5>
                        <ul>
                            <li><a href="{{ route('about') }}">Tentang Kami</a></li>
                        </ul>
                    </div>
                </div>
                
				<div class="col-lg-3 col-md-6 mb-4">
					<div class="audio-player-container">
						<h5 class="audio-title">🎵 Musik Wukwuk</h5>
						<audio controls preload="auto">
							<source src="{{ url('/audio/Dian_Piesesha%20(online-audio-converter.com).mp3') }}" type="audio/mpeg">
							Browser kamu tidak mendukung audio tag.
						</audio>
                    </div>	
                </div>
            </div>
            
            <div class="footer-bottom text-center">
                <p class="mb-0">&copy; {{ date('Y') }} KomioMusik. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar-custom');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
        
        // Initialize date/time pickers
        flatpickr("#tanggal", {
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
            minDate: "today",
            theme: "material_blue",
            disableMobile: true
        });
        
        flatpickr("#jam_mulai", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true
        });
        
        flatpickr("#jam_selesai", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true
        });
        
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>

</body>
</html>