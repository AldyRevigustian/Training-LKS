<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\SiswaController;

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

Route::get('/guru', [GuruController::class, 'index']);
Route::get('/guru/create', [GuruController::class, 'create']);
Route::post('/guru', [GuruController::class, 'store']);
Route::get('/guru/{id}/edit', [GuruController::class, 'edit']);
Route::put('/guru/{id}', [GuruController::class, 'update']);
Route::delete('/guru/{id}', [GuruController::class, 'destroy']);

Route::get('/kelas', [KelasController::class, 'index']);
Route::get('/kelas/create', [KelasController::class, 'create']);
Route::post('/kelas', [KelasController::class, 'store']);
Route::get('/kelas/{id}/edit', [KelasController::class, 'edit']);
Route::put('/kelas/{id}', [KelasController::class, 'update']);
Route::delete('/kelas/{id}', [KelasController::class, 'destroy']);

Route::get('/siswa', [SiswaController::class, 'index']);
Route::get('/siswa/create', [SiswaController::class, 'create']);
Route::post('/siswa', [SiswaController::class, 'store']);
Route::get('/siswa/{id}/edit', [SiswaController::class, 'edit']);
Route::put('/siswa/{id}', [SiswaController::class, 'update']);
Route::delete('/siswa/{id}', [SiswaController::class, 'destroy']);

Route::get('/mapel', [MapelController::class, 'index']);
Route::get('/mapel/create', [MapelController::class, 'create']);
Route::post('/mapel', [MapelController::class, 'store']);
Route::get('/mapel/{id}/edit', [MapelController::class, 'edit']);
Route::put('/mapel/{id}', [MapelController::class, 'update']);
Route::delete('/mapel/{id}', [MapelController::class, 'destroy']);

