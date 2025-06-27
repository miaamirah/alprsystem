<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlateController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\VehicleLogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegisteredVehicleController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Login page (public)
Route::get('/', function () {
    return view('auth.login');
});

// Laravel's auth routes (login, register, forgot password, etc)
Auth::routes();
Route::get('/auth-check', function () {
    dd(Auth::check(), Auth::user());
});

// All protected routes (require login)
Route::middleware(['auth'])->group(function () {

    // Home page after login (shows welcome.blade.php)
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    // Other protected routes
    Route::resource('plates', PlateController::class);
    Route::resource('vehicle-logs', VehicleLogController::class);
    Route::resource('reports', ReportController::class);
    Route::resource('users', UserController::class);
    Route::resource('registered_vehicles', RegisteredVehicleController::class);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
