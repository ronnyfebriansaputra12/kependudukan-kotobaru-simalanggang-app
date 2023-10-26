<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\JenisSuratController;
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
  Route::get('/penduduk', 'App\Http\Controllers\PendudukController@index');
  Route::get('/penduduk/create', 'App\Http\Controllers\PendudukController@create');
  Route::post('/penduduk', 'App\Http\Controllers\PendudukController@store');
  Route::patch('/uid-penduduk/{nik}', 'App\Http\Controllers\PendudukController@updateUID');
  Route::patch('/penduduk/{nik}', 'App\Http\Controllers\PendudukController@update');
  Route::get('/penduduk/{nik}', 'App\Http\Controllers\PendudukController@show');
  Route::get('/penduduk/delete/{nik}', 'App\Http\Controllers\PendudukController@destroy');
  Route::get('/penduduk/{penduduk}/edit', 'App\Http\Controllers\PendudukController@edit');
  Route::post('/penduduk-excel', [PendudukController::class, 'importExcel']);

  Route::get('/profilePenduduk', [UserController::class, 'profilePenduduk']);
  Route::put('/changePassword', [UserController::class, 'changePassword']);

  Route::post('/auto-save', 'App\Http\Controllers\PendudukController@autoSave');

  Route::get('/jenis-surat', [JenisSuratController::class, 'index']);
  Route::post('/jenis-surat', [JenisSuratController::class, 'store']);

  Route::get('/pengajuan', [PengajuanController::class, 'index'])->name('pengajuan');
  Route::get('/pengajuan/create/{nik}', [PengajuanController::class, 'create'])->name('pengajuan-create');
  Route::post('/pengajuan', [PengajuanController::class, 'store'])->name('pengajuan');
});
