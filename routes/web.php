<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\JenisSuratController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PencarianController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\UserController;
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

Route::get('/', [PencarianController::class, 'index']);
Route::get('/detail-penduduk/{nik}', [PencarianController::class, 'detailPenduduk']);
Route::middleware(['AfterLogin'])->group(function () {

  Route::get('/login/{nik}', 'App\Http\Controllers\AuthController@loginPenduduk')->name('login');;
  Route::get('/loginAdmin', 'App\Http\Controllers\AuthController@loginAdmin');
  Route::post('/loginProsesAdmin', 'App\Http\Controllers\AuthController@loginProsesAdmin');
  Route::post('/loginProsesPenduduk', 'App\Http\Controllers\AuthController@loginProsesPenduduk');
});

Route::get('/logout', 'App\Http\Controllers\AuthController@logout');


Route::middleware(['isLogin'])->group(function () {
  Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index');
  // Route::resource('penduduk', PendudukController::class);
  Route::resource('pengguna', UserController::class);
  Route::get('/penduduk', 'App\Http\Controllers\PendudukController@index');
  Route::get('/penduduk/create', 'App\Http\Controllers\PendudukController@create');
  Route::post('/penduduk', 'App\Http\Controllers\PendudukController@store');
  Route::patch('/uid-penduduk/{nik}', 'App\Http\Controllers\PendudukController@updateUID');
  Route::patch('/penduduk/{nik}', 'App\Http\Controllers\PendudukController@update');
  Route::get('/penduduk/{nik}', 'App\Http\Controllers\PendudukController@show');
  Route::get('/penduduk/delete/{nik}', 'App\Http\Controllers\PendudukController@destroy');
  Route::get('/penduduk/{penduduk}/edit', 'App\Http\Controllers\PendudukController@edit');
  Route::post('/penduduk-excel', [PendudukController::class, 'importExcel']);

  Route::get('/capture/{nik}', 'App\Http\Controllers\CaptureController@index');
  Route::post('/check-nik-exists', 'App\Http\Controllers\CaptureController@checkNikExists');
  Route::get('/capture', 'App\Http\Controllers\CaptureController@captureData');
  Route::delete('/capture-delete/{nik}', 'App\Http\Controllers\CaptureController@deleteCapture');
  Route::post('/simpan-gambar', 'App\Http\Controllers\CaptureController@store');

  Route::get('/mark-as-read/{id}', [NotificationController::class, 'markAsRead']);
  Route::get('/mark-as-all-read', [NotificationController::class, 'markAllAsRead']);


  Route::get('/profileAdmin/{id}',[UserController::class, 'profileAdmin']);
  Route::put('/profileAdmin/update/{id}', [UserController::class, 'updateAdmin']);

  Route::get('/profilePenduduk/{nik}', [UserController::class, 'profilePenduduk']);
  Route::put('/changePassword', [UserController::class, 'changePassword']);
  Route::put('/profilePenduduk/update/{nik}', [UserController::class, 'update']);

  Route::post('/auto-save', 'App\Http\Controllers\PendudukController@autoSave');

  Route::get('/jenis-surat', [JenisSuratController::class, 'index']);
  Route::post('/jenis-surat', [JenisSuratController::class, 'store']);
  Route::get('/jenis-surat/delete/{id}', [JenisSuratController::class, 'destroy']);
  Route::put('/jenis-surat/{id}', [JenisSuratController::class,'update']);

  Route::get('/pengajuan', [PengajuanController::class, 'index'])->name('pengajuan');
  Route::get('/pengajuan/create/{nik}', [PengajuanController::class, 'create'])->name('pengajuan-create');
  Route::post('/pengajuan', [PengajuanController::class, 'store'])->name('pengajuan');
  Route::put('/pengajuan/{id}', [PengajuanController::class, 'update']);

  // routes/web.php

  // Route::get('/print-surat/{type}/{id}', [PengajuanController::class, 'cetakSurat'])->name('print-surat');

  // routes/web.php


  Route::get('/cetak-surat/{id_jenis_surat}', [PengajuanController::class, 'cetakSurat']);

  // Route::get('/cetak-surat/{id}', [PengajuanController::class, 'cetakSurat'])->name('cetak-surat');
  // Menggunakan regular expression untuk memastikan jenis_surat hanya angka

});
