    <!DOCTYPE html> 
    <html dir="ltr" lang="en"> 
    
    <head> 
        <meta charset="utf-8"> 
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <meta name="description" content=""> 
        <meta name="author" content=""> 
        <link rel="icon" type="images/png" sizes="16x16" href="{{ asset('backend/images/komisangitar.png') }}"> 
        <title>KomioMusik</title> 

        <!-- Custom CSS --> 
        <link rel="stylesheet" type="text/css" href="{{ asset('backend/extralibs/multicheck/multicheck.css') }}"> 
        <link href="{{ asset('backend/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet"> 
        <link href="{{ asset('backend/dist/css/style.min.css') }}" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&display=swap" rel="stylesheet">
        <link href="https://cdn.materialdesignicons.com/6.5.95/css/materialdesignicons.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">


        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries --> 
        <!--[if lt IE 9]> 
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script> 
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script> 
        <![endif]--> 

        <style>
            /* Responsive Fixes */
            .left-sidebar {
                transition: width 0.3s ease;
            }
            
            .page-wrapper {
                transition: margin-left 0.3s ease;
            }
            
            .brand-text {
                font-family: 'Orbitron', sans-serif;
                font-size: 28px;
                font-weight: 700;
                background: linear-gradient(45deg, #00c6ff, #0072ff);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                margin-left: 15px;
                padding: 12px 0;
                white-space: nowrap;
            }
            
            .mobile-toggle {
                display: none;
                cursor: pointer;
                padding: 10px;
                color: #fff;
                position: fixed;
                left: 10px;
                top: 10px;
                z-index: 1100;
            }
            
            @media (max-width: 767px) {
                .left-sidebar {
                    position: fixed;
                    left: 0;
                    top: 0;
                    bottom: 0;
                    width: 250px;
                    z-index: 1000;
                    transform: translateX(-100%);
                    transition: transform 0.3s ease;
                }
                
                .left-sidebar.show {
                    transform: translateX(0);
                }
                
                .page-wrapper {
                    width: 100%;
                    margin-left: 0 !important;
                }
                
                .mobile-toggle {
                    display: block !important;
                }
                
                .navbar-brand {
                    margin-left: 40px;
                }
            }
            
            /* Collapsed Sidebar Styles */
            .left-sidebar.collapsed {
                width: 70px;
            }
            
            .left-sidebar.collapsed .hide-menu {
                display: none;
            }
            
            .left-sidebar.collapsed .sidebar-item.has-arrow:after {
                display: none;
            }
            
            .left-sidebar.collapsed .sidebar-nav i {
                margin-right: 0;
                font-size: 20px;
            }
            
            .left-sidebar.collapsed .sidebar-item {
                text-align: center;
            }
            
            .page-wrapper.collapsed-menu {
                margin-left: 70px;
            }

            .page-wrapper {
                padding-top: 70px;
                margin-left: 250px;
            }

            .left-sidebar .scroll-sidebar {
                overflow-y: auto;
                height: calc(100vh - 70px);
            }

        </style>
    </head>
    
    <body> 
        <!-- Preloader --> 
        <div class="preloader"> 
            <div class="lds-ripple"> 
                <div class="lds-pos"></div> 
                <div class="lds-pos"></div> 
            </div> 
        </div> 
        
        <!-- Mobile Toggle Button -->
        <a class="mobile-toggle d-md-none" href="javascript:void(0)">
            <i class="fas fa-bars"></i>
        </a>

        <!-- Main wrapper --> 
        <div id="main-wrapper"> 
            <!-- Topbar header --> 
            <header class="topbar position-fixed w-100 top-0" style="z-index: 1030;" data-navbarbg="skin5"> 
                <nav class="navbar top-navbar navbar-expand-md navbar-dark"> 
                    <div class="navbar-header" data-logobg="skin5"> 
                        
                        <!-- Logo --> 
                        <div class="d-flex justify-content-center w-100">
                            <a class="navbar-brand">
                                <h3 class="brand-text mb-0">Komio Musik</h3>
                            </a>
                        </div>

                        <!-- Toggle visible on mobile --> 
                        <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="ti-more"></i>
                        </a> 
                    </div> 
                    
                    <!-- Navbar items --> 
                    <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5"> 
                        <ul class="navbar-nav mr-auto">
                            <!-- Desktop sidebar toggle --> 
                            <li class="nav-item">
                                <a class="nav-link sidebar-toggle d-none d-md-block" href="javascript:void(0)">
                                    <i class="fas fa-bars"></i>
                                </a>
                            </li>
                        </ul> 
                        
                        <!-- Right side nav items - Profile --> 
                        <ul class="navbar-nav float-right">
                            <li class="nav-item dropdown"> 
                                <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" ariaexpanded="false"> 
                                    @if (Auth::user()->foto) 
                                    <img src="{{ asset('storage/img-user/' . Auth::user()->foto) }}" alt="user" class="rounded-circle" width="31"> 
                                    @else 
                                    <img src="{{ asset('storage/img-user/img-default.jpg') }}" alt="user" class="rounded-circle" width="31"> 
                                    @endif 
                                </a> 
                                <div class="dropdown-menu dropdown-menu-right user-dd animated"> 
                                    <a class="dropdown-item" href="{{ route('backend.user.edit', Auth::user()->id) }}"><i class="ti-user m-r-5 m-l-5"></i> Profil Saya</a> 
                                    <a class="dropdown-item" href="" onclick="event.preventDefault(); document.getElementById('keluar-app').submit();"><i class="fa fa-power-off m-r-5 m-l-5"></i> Keluar</a> 
                                    <div class="dropdown-divider"></div> 
                                </div> 
                            </li> 
                        </ul>
                    </div> 
                </nav> 
            </header> 
            
            <!-- Left Sidebar --> 
            <aside class="left-sidebar position-fixed vh-100" style="top: 70px; z-index: 1020;" data-sidebarbg="skin5"> 
                <div class="scroll-sidebar"> 
                    <nav class="sidebar-nav"> 
                        <ul id="sidebarnav" class="p-t-30"> 
                            <!-- Dashboard -->
                            <li class="sidebar-item"> 
                                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('backend.beranda') }}" aria-expanded="false">
                                    <i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span>
                                </a> 
                            </li>

                            <!-- Manajemen User -->
                            <li class="sidebar-item"> 
                                <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                    <i class="mdi mdi-account-multiple"></i><span class="hide-menu">Manajemen User</span>
                                </a> 
                                <ul aria-expanded="false" class="collapse first-level"> 
                                    <li class="sidebar-item"><a href="{{ route('backend.user.index') }}" class="sidebar-link"><i class="mdi mdi-account"></i><span class="hide-menu"> User </span></a></li>
                                </ul> 
                            </li>

                            <!-- Manajemen Studio -->
                            <li class="sidebar-item">
                                <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)">
                                    <i class="fas fa-cogs"></i><span class="hide-menu">Manajemen Studio</span>
                                </a>
                                <ul aria-expanded="false" class="collapse first-level"> 
                                    <li class="sidebar-item"><a href="{{ route('backend.ruangan.index') }}" class="sidebar-link"><i class="mdi mdi-home-modern"></i><span class="hide-menu"> Ruangan Studio </span></a></li>
                                    <li class="sidebar-item"><a href="{{ route('backend.fasilitas.index')}}" class="sidebar-link"><i class="mdi mdi-tools"></i><span class="hide-menu"> Fasilitas Studio </span></a></li>
                                    <li class="sidebar-item"><a href="{{ route('backend.harga.index') }}" class="sidebar-link"><i class="mdi mdi-currency-usd"></i><span class="hide-menu"> Harga Sewa </span></a></li>
                                </ul> 
                            </li>

                            <!-- Manajemen Jadwal -->
                            <li class="sidebar-item"> 
                                <a class="sidebar-link waves-effect waves-dark" href="{{ route('backend.jadwal.index') }}" aria-expanded="false">
                                    <i class="mdi mdi-calendar-clock"></i><span class="hide-menu">Manajemen Jadwal</span>
                                </a> 
                            </li>

                            <!-- Manajemen Booking -->
                            <li class="sidebar-item"> 
                                <a class="sidebar-link waves-effect waves-dark" href="{{ route('backend.booking.index') }}" aria-expanded="false">
                                    <i class="mdi mdi-calendar-check"></i><span class="hide-menu">Manajemen Booking</span>
                                </a> 
                            </li>

                            <!-- Manajemen Pembayaran -->
                            <li class="sidebar-item"> 
                                <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                    <i class="mdi mdi-cash"></i><span class="hide-menu">Pembayaran</span>
                                </a> 
                                <ul aria-expanded="false" class="collapse first-level"> 
                                    <li class="sidebar-item"><a href="{{ route('backend.pembayaran.index') }}" class="sidebar-link"><i class="mdi mdi-cash-multiple"></i><span class="hide-menu"> Daftar Pembayaran</span></a></li>
                                    <li class="sidebar-item"><a href="{{ route('backend.pembayaran.lunas') }}" class="sidebar-link"><i class="mdi mdi-check-circle"></i><span class="hide-menu"> Pembayaran Lunas </span></a></li>
                                </ul> 
                            </li>

                            <!-- Manajemen Review -->
                            <li class="sidebar-item"> 
                                <a class="sidebar-link waves-effect waves-dark" href="{{ route('backend.review.index') }}" aria-expanded="false">
                                    <i class="mdi mdi-star-circle"></i><span class="hide-menu">Manajemen Review</span>
                                </a> 
                            </li>

                            <!-- Laporan & Statistik -->
                            <li class="sidebar-item"> 
                                <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                    <i class="mdi mdi-file-chart"></i><span class="hide-menu">Laporan</span>
                                </a> 
                                <ul aria-expanded="false" class="collapse first-level"> 
                                    <li class="sidebar-item"><a href="{{ route('backend.laporan.transaksi') }}" class="sidebar-link"><i class="mdi mdi-calendar"></i><span class="hide-menu"> Transaksi per Periode </span></a></li>
                                    <li class="sidebar-item"><a href="{{ route('backend.laporan.ruangan_terfavorit') }}" class="sidebar-link"><i class="mdi mdi-office-building"></i><span class="hide-menu"> Ruangan Terfavorit </span></a></li>
                                    <li class="sidebar-item"><a href="{{ route('backend.laporan.keuangan') }}" class="sidebar-link"><i class="mdi mdi-cash"></i><span class="hide-menu">Laporan Keuangan</span></a></li>
                                    <li class="sidebar-item"><a href="{{ route('backend.laporan.bulan') }}" class="sidebar-link"><i class="mdi mdi-calendar-month"></i><span class="hide-menu">Laporan Booking / Bulan</span></a></li>
                                    <li class="sidebar-item"><a href="{{ route('backend.laporan.user') }}" class="sidebar-link"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">User Aktif</span></a></li>
                                <!-- Submenu Export Data -->
                                    <li class="sidebar-item"> 
                                        <a class="sidebar-link waves-effect waves-dark" href="{{ route('backend.laporan.pdf') }}" aria-expanded="false">
                                            <i class="mdi mdi-star-circle"></i><span class="hide-menu">Export PDF</span>
                                        </a> 
                                    </li>
                                </ul> 
                            </li>

                            <!-- Pengaturan Sistem -->
                            <li class="sidebar-item"> 
                                <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                    <i class="mdi mdi-settings"></i><span class="hide-menu">Pengaturan Sistem</span>
                                </a> 
                                <ul aria-expanded="false" class="collapse first-level"> 
                                    <li class="sidebar-item"><a href="{{ route('backend.jam_operasional.index') }}" class="sidebar-link"><i class="mdi mdi-clock-outline"></i><span class="hide-menu"> Jam Operasional </span></a></li>
                                    <li class="sidebar-item"><a href="#" class="sidebar-link"><i class="mdi mdi-bank-transfer"></i><span class="hide-menu"> Metode Pembayaran </span></a></li>
                                </ul> 
                            </li>
                        </ul>
                    </nav>
                </div> 
            </aside>
            
            <!-- Page wrapper --> 
            <div class="page-wrapper"> 
                <!-- Container fluid --> 
                <div class="container-fluid"> 
                    <!-- Page Content --> 
                    @yield('content') 
                </div> 
                
                <!-- Footer --> 
                <footer class="footer text-center"> 
                    Copyright &copy; 2045 INDONESIA EMAS 
                </footer> 
            </div> 
        </div> 
        
        <!-- All Jquery --> 
        <script src="{{ asset('backend/libs/jquery/dist/jquery.min.js') }}"></script>
        <!-- Bootstrap tether Core JavaScript --> 
        <script src="{{ asset('backend/libs/popper.js/dist/umd/popper.min.js') }}"></script> 
        <script src="{{ asset('backend/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <!-- slimscrollbar scrollbar JavaScript --> 
        <script src="{{ asset('backend/libs/perfect-scrollbar/dist/perfectscrollbar.jquery.min.js') }}"></script> 
        <script src="{{ asset('backend/extra-libs/sparkline/sparkline.js') }}"></script> 
        <!--Wave Effects --> 
        <script src="{{ asset('backend/dist/js/waves.js') }}"></script> 
        <!--Menu sidebar --> 
        <script src="{{ asset('backend/dist/js/sidebarmenu.js') }}"></script> 
        <!--Custom JavaScript --> 
        <script src="{{ asset('backend/dist/js/custom.min.js') }}"></script> 
        <!-- this page js --> 
        <script src="{{ asset('backend/extra-libs/multicheck/datatable-checkbox-init.js') }}"></script> 
        <script src="{{ asset('backend/extra-libs/multicheck/jquery.multicheck.js') }}"></script> 
        <script src="{{ asset('backend/extra-libs/DataTables/datatables.min.js') }}"></script> 
        
        <!-- Fixed Toggle Script -->
        <script>
            $(document).ready(function() {
                // Mobile toggle functionality
                $('.mobile-toggle').on('click', function() {
                    $('.left-sidebar').toggleClass('show');
                });
                
                // Desktop toggle functionality
                $('.sidebar-toggle').on('click', function() {
                    $('.left-sidebar').toggleClass('collapsed');
                    $('.page-wrapper').toggleClass('collapsed-menu');
                });
                
                // Close mobile menu when clicking outside
                $(document).on('click', function(e) {
                    if ($(window).width() <= 767 && 
                        !$(e.target).closest('.left-sidebar').length && 
                        !$(e.target).closest('.mobile-toggle').length) {
                        $('.left-sidebar').removeClass('show');
                    }
                });
                
                // Initialize DataTable
                $('#zero_config').DataTable();
                
                // Handle window resize
                $(window).resize(function() {
                    if ($(window).width() > 767) {
                        $('.left-sidebar').removeClass('show');
                    }
                });
            });
        </script>
        
        <!-- form keluar app --> 
        <form id="keluar-app" action="{{ route('backend.logout') }}" method="POST" class="d-none"> 
            @csrf 
        </form> 
    
        <!-- sweetalert --> 
        <script src="{{ asset('sweetalert/sweetalert2.all.min.js') }}"></script>
        
        <!-- konfirmasi success--> 
        @if (session('success')) 
        <script> 
            Swal.fire({ 
                icon: 'success', 
                title: 'Berhasil!', 
                text: "{{ session('success') }}" 
            }); 
        </script> 
        @endif 
        
        <!-- Konfirmasi delete -->
        <script type="text/javascript"> 
            $('.show_confirm').click(function(event) { 
                var form = $(this).closest("form"); 
                var konfdelete = $(this).data("konf-delete"); 
                event.preventDefault(); 
                Swal.fire({ 
                    title: 'Konfirmasi Hapus Data?', 
                    html: "Data yang dihapus <strong>" + konfdelete + "</strong> tidak dapat dikembalikan!", 
                    icon: 'warning', 
                    showCancelButton: true, 
                    confirmButtonColor: '#3085d6', 
                    cancelButtonColor: '#d33', 
                    confirmButtonText: 'Ya, dihapus', 
                    cancelButtonText: 'Batal' 
                }).then((result) => { 
                    if (result.isConfirmed) { 
                        Swal.fire('Terhapus!', 'Data berhasil dihapus.', 'success') 
                        .then(() => { 
                            form.submit(); 
                        }); 
                    } 
                }); 
            }); 
        </script> 
        
        <!-- previewFoto -->
        <script> 
            function previewFoto() { 
                const foto = document.querySelector('input[name="foto"]'); 
                const fotoPreview = document.querySelector('.foto-preview'); 
                fotoPreview.style.display = 'block'; 
                const fotoReader = new FileReader(); 
                fotoReader.readAsDataURL(foto.files[0]); 
                fotoReader.onload = function(fotoEvent) { 
                    fotoPreview.src = fotoEvent.target.result; 
                    fotoPreview.style.width = '100%'; 
                } 
            } 
        </script> 
        
        <!-- CKEditor -->
        <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
        <script> 
            ClassicEditor 
                .create(document.querySelector('#ckeditor')) 
                .catch(error => { 
                    console.error(error); 
                }); 
        </script> 
    @stack('scripts')
    </body> 
    </html>