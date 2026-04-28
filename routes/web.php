<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController; 
use App\Livewire\DestinationDetail;
use App\Models\Destination;

Route::view('/', 'welcome');

Route::get('/destinations/{slug}', DestinationDetail::class)->name('destination.detail');

Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

// Tambahkan di bawah route admin yang sudah ada
Route::get('/admin/culinaries', function () {
    return view('admin.culinaries');
})->name('admin.culinaries');

Route::get('/admin/cultures', function () {
    return view('admin.cultures');
})->name('admin.cultures');

Route::get('/admin/events', function () {
    return view('admin.events');
})->name('admin.events');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/destination/{slug}', DestinationDetail::class)->name('destination.detail');

Route::get('/', function () {
    // Ambil satu destinasi random atau yang is_top_destination = 1
    $featured = Destination::where('is_top_destination', 1)->first() ?? Destination::first();
    
    return view('welcome', compact('featured'));
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
