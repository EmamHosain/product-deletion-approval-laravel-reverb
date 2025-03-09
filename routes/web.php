<?php

use App\Http\Middleware\AdminAuthMiddleware;
use App\Http\Middleware\UserAuthMiddleware;
use App\Livewire\AdminDashboard;
use App\Livewire\Products;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';

Route::get('/dashboard', AdminDashboard::class)->name('dashboard')->middleware(AdminAuthMiddleware::class);
Route::get('/products', Products::class)->name('products')->middleware(UserAuthMiddleware::class);
