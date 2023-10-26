<?php

use App\Http\Controllers\Bukutamu;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/admin', [Controller::class, 'admin'])->name('admin');
Route::get('/buku_tamu', [Bukutamu::class, 'bukutamu'])->name('buku_tamu');

Auth::routes([

  'register' => false, // Register Routes...

  'reset' => false, // Reset Password Routes...

  'verify' => false, // Email Verification Routes...

]);