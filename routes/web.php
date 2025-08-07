<?php

use App\Http\Controllers\AuthController;
use App\Livewire\AdminDashboardLivewireComponent;
use App\Livewire\AdminOrdersLivewireComponent;
use App\Livewire\ClientDashboardLivewireComponent;
use App\Livewire\ClientOrdersLivewireComponent;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::middleware(['auth', 'role:client'])->prefix('client')->name('client.')->group(function () {
    Route::get('dashboard', ClientDashboardLivewireComponent::class)->name('dashboard');
    Route::get('orders', ClientOrdersLivewireComponent::class)->name('orders');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', AdminDashboardLivewireComponent::class)->name('dashboard');
    Route::get('orders', AdminOrdersLivewireComponent::class)->name('orders');
});
