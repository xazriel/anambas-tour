<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// Import Guzzle Client
use Illuminate\Support\Facades\Http;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Paksa semua HTTP request untuk tidak verifikasi SSL (khusus lokal)
        if (app()->environment('local')) {
            Http::globalOptions([
                'verify' => false,
            ]);
        }
    }
}