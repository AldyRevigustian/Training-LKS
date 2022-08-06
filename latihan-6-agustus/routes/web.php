<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TicketController;
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

Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'submitLogin']);
Route::post('/logout', [AuthController::class, 'logout']);


Route::prefix('events')->group(function () {
    Route::get('/', [EventController::class, 'index']);
    Route::get('/create', [EventController::class, 'create']);
    Route::post('/', [EventController::class, 'store']);
    Route::get('/{event}', [EventController::class, 'show']);
    Route::get('/{event}/edit', [EventController::class, 'edit']);
    Route::put('/{event}', [EventController::class, 'update']);

    Route::prefix('/{event}')->group(function () {
        Route::get('/tickets/create', [TicketController::class, 'create']);
        Route::post('/tickets', [TicketController::class, 'store']);

        Route::get('/channels/create', [ChannelController::class, 'create']);
        Route::post('/channels', [ChannelController::class, 'store']);

        Route::get('/rooms/create', [RoomController::class, 'create']);
        Route::post('/rooms', [RoomController::class, 'store']);

        Route::get('/sessions/create', [SessionController::class, 'create']);
        Route::post('/sessions', [SessionController::class, 'store']);
    });
});
