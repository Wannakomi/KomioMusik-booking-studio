<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookingStudioController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\HargaSewaController;
use App\Http\Controllers\JadwalStudioController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\JamOperasionalController;
use App\Http\Controllers\Frontend\LokasiController as FrontLokasi;
use App\Http\Controllers\Frontend\ReviewController as FrontReview;
use App\Http\Controllers\Frontend\BookingController as UserBookingController;

Route::get('/unauthorized', function () {
    return view('unauthorized');
})->name('unauthorized');

Route::get('/audio/{filename}', function ($filename) {
    $path = storage_path("app/public/audio/{$filename}");

    if (!file_exists($path)) {
        abort(404);
    }

    $mimeType = mime_content_type($path);

    return Response::make(file_get_contents($path), 200, [
        'Content-Type' => $mimeType,
        'Content-Length' => filesize($path),
        'Accept-Ranges' => 'bytes',
        'Content-Disposition' => 'inline; filename="' . $filename . '"',
    ]);
});


/*
|--------------------------------------------------------------------------
| FRONTEND ROUTES
|--------------------------------------------------------------------------
*/

// Home & Beranda
Route::get('/', fn() => redirect()->route('beranda'));
Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');

// Auth Frontend
Route::get('/login', [LoginController::class, 'loginFrontend'])->name('login');
Route::post('/login', [LoginController::class, 'authenticateFrontend']);
Route::post('/register', [LoginController::class, 'storeFrontend']);
Route::get('/register', [LoginController::class, 'registerFrontend'])->name('register');
Route::post('/register', [LoginController::class, 'registerFrontendPost']);
Route::post('/logout', [LoginController::class, 'logoutFrontend'])->name('logout');

// Profile - Frontend (USER ONLY - Role 1)
Route::middleware(['auth', \App\Http\Middleware\CheckRole::class . ':1'])->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [UserController::class, 'editProfile'])->name('frontend.profile.edit');
    Route::put('/profile/update', [UserController::class, 'updateProfile'])->name('frontend.profile.update');
});

// Ruangan - Frontend (Public Access)
Route::get('/ruangan', [RuanganController::class, 'indexFrontend'])->name('v_ruangan.index');
Route::get('/ruangan/{slug}', [RuanganController::class, 'show'])->name('v_ruangan.detail');


Route::get('/lokasi', [FrontLokasi::class, 'index'])->name('frontend.lokasi');


Route::middleware(['auth', \App\Http\Middleware\CheckRole::class . ':1'])->group(function () {
    Route::get('/booking-form', [UserBookingController::class, 'userIndex'])->name('booking.user.index');
    Route::get('/booking', [UserBookingController::class, 'create'])->name('booking.user.create');
    Route::post('/booking', [UserBookingController::class, 'storeFrontend'])->name('booking.user.store');
    Route::post('/booking/{id}/cancel', [UserBookingController::class, 'cancel'])->name('booking.cancel');
    Route::post('/booking/{id}/restore', [UserBookingController::class, 'restore'])->name('booking.restore');
    Route::get('/get-harga-ruangan/{id}', [UserBookingController::class, 'getHargaRuangan']);

});

Route::middleware('auth')->group(function () {
    Route::get('/bayar', [PembayaranController::class, 'indexIndex'])->name('bayar.index');
    Route::get('/bayar/{id}', [PembayaranController::class, 'showFrontend'])->name('bayar.show');
    Route::post('/bayar/{id}', [PembayaranController::class, 'storeFrontend'])->name('bayar.store');
    Route::post('/pembayaran/kirim/{id}', [PembayaranController::class, 'storeFrontend'])->name('bayar.frontend');
    Route::get('/struk-pembayaran/{id}', [PembayaranController::class, 'generateStruk'])->name('pembayaran.struk');

});

Route::post('/review', [FrontReview::class, 'store'])->name('review.store');
Route::delete('/review/{id}', [ReviewController::class, 'destroy'])->name('review.delete');


Route::get('/about-us', function () {
    return view('frontend.about');
})->name('about');

/*
|--------------------------------------------------------------------------
| BACKEND ROUTES
|--------------------------------------------------------------------------
*/

// Auth Backend
Route::get('backend/login', [LoginController::class, 'loginBackend'])->name('backend.login');
Route::post('backend/login', [LoginController::class, 'authenticateBackend']);
Route::post('backend/logout', [LoginController::class, 'logoutBackend'])->name('backend.logout');

Route::middleware(['auth:admin', \App\Http\Middleware\CheckRole::class . ':0'])->prefix('backend')->name('backend.')->group(function () {
    // route admin...

    Route::get('backend/login', [LoginController::class, 'loginBackend'])->name('backend.login');
    Route::post('backend/login', [LoginController::class, 'authenticateBackend']);
    Route::post('backend/logout', [LoginController::class, 'logoutBackend'])->name('backend.logout');

    // Beranda
    Route::get('beranda', [BerandaController::class, 'berandaBackend'])->name('beranda');

    // User Management - ADMIN ONLY
    Route::resource('user', UserController::class);
    Route::get('user/{id}/reset-password', [UserController::class, 'showResetPasswordForm'])->name('user.reset-password');
    Route::put('user/{id}/reset-password', [UserController::class, 'resetPassword'])->name('user.reset-password.update');
    Route::get('laporan/formuser', [UserController::class, 'formUser'])->name('laporan.formuser');
    Route::post('laporan/cetakuser', [UserController::class, 'cetakUser'])->name('laporan.cetakuser');

    // Booking Studio - ADMIN ONLY
    Route::resource('booking', BookingStudioController::class);

    // Ruangan - ADMIN ONLY
    Route::resource('ruangan', RuanganController::class);

    // Fasilitas - ADMIN ONLY
    Route::resource('fasilitas', FasilitasController::class);

    // Harga Sewa - ADMIN ONLY
    Route::resource('harga', HargaSewaController::class);

    // Jadwal Studio - ADMIN ONLY
    Route::resource('jadwal', JadwalStudioController::class);

    // Pembayaran - ADMIN ONLY
    Route::resource('pembayaran', PembayaranController::class);
    Route::post('pembayaran/{id}/mark-as-paid', [PembayaranController::class, 'markAsPaid'])->name('pembayaran.markAsPaid');
    Route::get('pembayaran-lunas', [PembayaranController::class, 'pembayaranLunas'])->name('pembayaran.lunas');

    // Review - ADMIN ONLY
    Route::get('review', [ReviewController::class, 'index'])->name('review.index');
    Route::patch('review/{id}/toggle', [ReviewController::class, 'toggle'])->name('review.toggle');
    Route::delete('review/{id}', [ReviewController::class, 'destroy'])->name('review.destroy');

    // Laporan - ADMIN ONLY
    Route::get('laporan/transaksi', [LaporanController::class, 'transaksiPeriode'])->name('laporan.transaksi');
    Route::post('laporan/transaksi', [LaporanController::class, 'hasilTransaksiPeriode'])->name('laporan.transaksi.hasil');
    Route::get('laporan/ruangan-terfavorit', [LaporanController::class, 'ruanganTerfavorit'])->name('laporan.ruangan_terfavorit');
    Route::get('laporan/keuangan', [LaporanController::class, 'keuangan'])->name('laporan.keuangan');
    Route::get('laporan/booking-per-bulan', [LaporanController::class, 'bookingPerBulan'])->name('laporan.bulan');
    Route::get('laporan/user-aktif', [LaporanController::class, 'userAktif'])->name('laporan.user');
    Route::get('laporan/export-pdf', [LaporanController::class, 'exportPDF'])->name('laporan.pdf');

    // Jam Operasional - ADMIN ONLY
    Route::resource('jam_operasional', JamOperasionalController::class);
});