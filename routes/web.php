<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlateController;
use App\Http\Controllers\VehicleLogController;
Route::get('/', function () {
    return view('auth.login');
});

Route::get('/index', function () {
    return view('index');
});

Route::get('/charts', function () {
    return view('charts');
});

Route::get('/loginpage', function () {
    return view('loginpage');
});

Route::resource('plates', PlateController::class);
Route::resource('vehicle-logs', VehicleLogController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
