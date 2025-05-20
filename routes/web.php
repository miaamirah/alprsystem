<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlateController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\VehicleLogController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/charts', function () {
    return view('charts');
});

Route::get('/loginpage', function () {
    return view('loginpage');
});

Route::resource('plates', PlateController::class);
Route::resource('vehicle-logs', VehicleLogController::class);
Route::resource('reports', ReportController::class);
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
