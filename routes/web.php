<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PinjamBukuController;
use App\Http\Controllers\RegisterController;
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

//Login
Route::get('/', [LoginController::class, 'login'])->name('login');
Route::post('actionLogin', [LoginController::class, 'actionLogin'])->name('actionLogin');

//Register
Route::get('register', [RegisterController::class, 'register'])->name('register');
Route::post('register/action', [RegisterController::class, 'actionRegister'])->name('actionRegister');
Route::get('register/verify/{verify_key}', [RegisterController::class, 'verify'])->name('verify');

//Logout
Route::get('logout', [LoginController::class, 'actionLogout'])->name('actionLogout')->middleware('auth');
Route::get('home', [HomeController::class, 'index'])->name('home')->middleware('auth');

//Buku
Route::get('buku', [BukuController::class, 'buku'])->name('buku')->middleware('auth');
Route::get('tambah', [BukuController::class, 'tambah'])->name('tambah');
Route::get('edit', [BukuController::class, 'edit'])->name('edit');
Route::post('actionTambah', [BukuController::class, 'actionTambah'])->name('actionTambah');
Route::post('actionEdit', [BukuController::class, 'actionEdit'])->name('actionEdit');
Route::post('actionDelete', [BukuController::class, 'actionDelete'])->name('actionDelete');

//Pinjam Buku
Route::get('pinjam', [PinjamBukuController::class, 'index'])->name('pinjam');
Route::post('pinjam/action', [PinjamBukuController::class, 'actionPinjam'])->name('actionPinjam');

//Kembalikan
Route::get('kembalikan', [PinjamBukuController::class, 'daftarPinjam'])->name('kembalikan');
Route::post('kembalikan/action', [PinjamBukuController::class, 'actionKembalikan'])->name('actionKembalikan');

//Debugging Route
// Route::get('/tambah', function () {
//     return view('editBuku');
// });
