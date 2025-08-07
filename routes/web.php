<?php

use App\Http\Controllers\AuthController;
use App\Livewire\AdminDashboardLivewireComponent;
use App\Livewire\AdminLocationsLivewireComponent;
use App\Livewire\AdminOrdersLivewireComponent;
use App\Livewire\AdminSchedulesLivewireComponent;
use App\Livewire\AdminTeamLivewireComponent;
use App\Livewire\AdminActivityLogsLivewireComponent;
use App\Livewire\ClientDashboardLivewireComponent;
use App\Livewire\ClientLocationsLivewireComponent;
use App\Livewire\ClientOrdersLivewireComponent;
use App\Livewire\ClientSchedulesLivewireComponent;
use App\Livewire\ClientTeamLivewireComponent;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::middleware(['auth', 'role:client'])->prefix('client')->name('client.')->group(function () {
    Route::get('dashboard', ClientDashboardLivewireComponent::class)->name('dashboard');
    Route::get('orders', ClientOrdersLivewireComponent::class)->name('orders');
    Route::get('schedules', ClientSchedulesLivewireComponent::class)->name('schedules');
    Route::get('locations', ClientLocationsLivewireComponent::class)->name('locations');
    Route::get('team', ClientTeamLivewireComponent::class)->name('team');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', AdminDashboardLivewireComponent::class)->name('dashboard');
    Route::get('orders', AdminOrdersLivewireComponent::class)->name('orders');
    Route::get('schedules', AdminSchedulesLivewireComponent::class)->name('schedules');
    Route::get('locations', AdminLocationsLivewireComponent::class)->name('locations');
    Route::get('team', AdminTeamLivewireComponent::class)->name('team');
    Route::get('activity-logs', AdminActivityLogsLivewireComponent::class)->name('activity-logs');
});

