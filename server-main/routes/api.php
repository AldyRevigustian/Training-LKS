<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\SquadController;
use App\Http\Controllers\SquadMemberController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/home', [HomeController::class, 'index']);
Route::group(['prefix' => 'auth'], function() {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
});

Route::get('squads', [SquadController::class, 'index']);
Route::get('squads/{squad}', [SquadController::class, 'show']);

Route::middleware('auth:sanctum')->group(function() {;
    Route::get('leaderboard', [ScoreController::class, 'get']);
    Route::post('score', [ScoreController::class, 'saveScore']);
    Route::put('users/{user}', [UserController::class, 'update']);

    Route::middleware(['admin'])->group(function() {
        Route::resource('banners', BannerController::class)->only(['index', 'store', 'update', 'destroy']);
        Route::resource('squads', SquadController::class)->only(['store', 'update', 'destroy']);
        Route::resource('squads/{squad}/members', SquadMemberController::class)->only(['index', 'store', 'update', 'destroy']);
        Route::resource('users', UserController::class)->only(['index','store', 'destroy']);
    });
});


