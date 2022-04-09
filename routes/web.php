<?php

use App\Http\Controllers\AlamatController;
use App\Http\Controllers\LaporController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UserController;


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
Route::view('/', 'welcome');
Route::get('/tes/{id}', [LaporController::class,'tes']);
Route::middleware('auth')->group(function(){
    Route::get('/home', [HomeController::class,'home']);
    Route::get('/lapor/{id}/tanggapan', [HomeController::class,'show']);
    Route::get('/dashboard', [DashboardController::class,'index']);
    Route::put('/profile', [UserController::class,'updateProfile']);
    Route::get('/profile', [UserController::class,'profile']);
    Route::get('/editpassword', [UserController::class,'editPassword']);
    Route::put('/editpassword', [UserController::class,'updatePassword']);
    Route::get('/user/{id}', [UserController::class,'showUser']);
    Route::post('/tanggapan', [HomeController::class,'store']);
    Route::delete('/tanggapan/{id}/delete', [HomeController::class,'deleteTanggapan']);
    Route::post('/support', [HomeController::class,'support']);
    Route::delete('/unsupport', [HomeController::class,'unsupport']);
    Route::get('/telegram_bot', [DashboardController::class,'telegramSetting']);
    Route::put('/telegram_bot', [DashboardController::class,'telegramUpdate']);

});
Route::middleware(['auth', 'user:user'])->group(function(){
    Route::get('/laporan_saya', [LaporController::class,'laporanSaya']);
    Route::get('/laporan_saya/{id}/lihat', [LaporController::class,'lihatLaporanSaya']);
    Route::get('/laporan_saya/{id}/edit', [LaporController::class,'editLaporanSaya']);
    Route::put('/laporan_saya/{id}/edit', [LaporController::class,'updateLaporanSaya']);
    Route::delete('/laporan_saya/{id}/delete', [LaporController::class,'deleteLaporanSaya']);
    Route::get('/lapor', [LaporController::class,'addLapor']);
    Route::post('/lapor', [LaporController::class,'store']);
});

Route::middleware('auth', 'petugas')->group(function(){
    Route::get('/masyarakat', [UserController::class,'showAllMasyarakat']);
    Route::get('/masyarakat/{id}', [UserController::class,'showUserAdmin']);
    Route::get('/data_lapor', [LaporController::class,'index']);
    Route::get('/cetak_laporan', [LaporController::class,'cetakLaporan']);
    Route::post('/cetak_laporan', [LaporController::class,'cetak']);
    Route::get('/cetak/{id}', [LaporController::class,'cetakId']);
    Route::post('/data_lapor/status/{id}', [LaporController::class,'ubahStatus']);
    Route::delete('/data_lapor/delete/{id}', [LaporController::class,'hapusLapor']);
    Route::get('/data_lapor/{id}/lihat', [LaporController::class,'show']);
    Route::delete('/delete_user/{id}', [UserController::class,'deleteUser']);
    Route::put('/is_active/{id}', [UserController::class,'statusActive']);

});

Route::middleware(['auth', 'user:admin'])->group(function(){
    Route::get('/petugas', [UserController::class,'showAllPetugas']);
    Route::get('/petugas/add', [UserController::class,'createPetugas']);
    Route::post('/petugas/add', [UserController::class,'storePetugas']);
    Route::get('/petugas/{id}', [UserController::class,'showPetugasAdmin']);
    Route::get('/alamat', [AlamatController::class,'index']);
    Route::post('/alamat/add', [AlamatController::class,'store']);
    Route::get('/alamat/{id}/edit', [AlamatController::class,'edit']);
    Route::put('/alamat/{id}/edit', [AlamatController::class,'update']);
    Route::delete('/alamat/{id}/delete', [AlamatController::class,'destroy']);
    Route::get('/kategori', [KategoriController::class,'index']);
    Route::post('/kategori/add', [KategoriController::class,'store']);
    Route::get('/kategori/{id}/edit', [KategoriController::class,'edit']);
    Route::put('/kategori/{id}/edit', [KategoriController::class,'update']);
    Route::delete('/kategori/{id}/delete', [KategoriController::class,'destroy']);
    
});


Auth::routes();


