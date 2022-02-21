<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');

Route::post('/dashboard', [DashboardController::class, 'index'])
    ->name('filter')
    ->middleware('auth');

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/profile', [ProfileController::class, 'index'])
    ->name('profile')
    ->middleware('auth');;
Route::post('/profile/upload', [ProfileController::class, 'upload'])
    ->name('upload')
    ->middleware('auth');;
Route::post('/profile', [ProfileController::class, 'store'])
    ->middleware('auth');;

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/', function () {
    return view('layouts.app');
});
