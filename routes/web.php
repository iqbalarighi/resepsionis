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
    return view('auth.login');
});

// Auth::routes();
Auth::routes([

  // 'register' => false, // Register Routes...

  // 'reset' => false, // Reset Password Routes...

  // 'verify' => false, // Email Verification Routes...

]);

Route::controller(HomeController::class)->group(function () {
Route::get('/home', 'index')->name('home');
Route::get('/selfie/{id}', 'selfie');
Route::post('/foto_selfie/{id}', 'fotoself');
Route::get('/identitas/{id}', 'identitas');
Route::post('/foto_identitas/{id}', 'fotoid');
// Route::get('/home/jam_pulang/{id}', 'checkout');
// Route::delete('/hapus-tamu/{id}', 'delete');
Route::get('/hapus_foto_selfie/{id}', 'delfoto');
Route::get('/hapus_foto_id/{id}', 'delid');
Route::get('/downloadPDF/{start}/{end}/{search}', 'onePDF');
Route::get('/downloadPDF/{start}/{end}', 'twoPDF');
Route::get('/downloadPDF/{search}', 'triPDF');

});


Route::controller(Bukutamu::class)->group(function () {
  Route::get('/safety_induction_soemitro',  'bukutamu')->name('safety_induction_soemitro');
  Route::post('/simpan', 'store')->name('simpan');
  Route::get('/konfirmasi/{nama}',  'konfirm');
});

