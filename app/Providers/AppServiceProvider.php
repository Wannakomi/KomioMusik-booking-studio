<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\BookingStudio;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            if (Auth::check() && Auth::user()->role == 1) {
                $bookings = BookingStudio::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
                $view->with('bookings', $bookings);
            } else {
                $view->with('bookings', collect());
            }
        });
    }
}
