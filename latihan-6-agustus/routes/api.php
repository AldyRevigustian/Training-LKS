<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\EventController;
use App\Http\Controllers\API\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('v1')->group(function(){
    Route::get('/events',[EventController::class, 'index']);
    Route::get('/organizers/{organizer_slug}/events/{event_slug}',[EventController::class, 'show']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('/organizers/{organizer_slug}/events/{event_slug}/registration',[EventController::class, 'register']);
    Route::get('/registrations',[UserController::class, 'registration']);

});
