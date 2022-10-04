<?php

use App\Http\Controllers\API\ApplicationController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\VacancyController;
use App\Http\Controllers\API\ValidationController;
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

Route::prefix('/v1')->group(function () {
    // Auth
    Route::post('/auth/login', [AuthController::class, 'login']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    // Validation
    Route::post('/validation', [ValidationController::class,'store']);
    Route::get('/validations', [ValidationController::class, 'index']);
    
    // Job Vacancies
    Route::get('/job_vacancies', [VacancyController::class, 'index']);
    Route::get('/job_vacancies/{id}', [VacancyController::class, 'show']);
    
    // Apply
    Route::post('/applications', [ApplicationController::class,'store']);
    Route::get('/applications', [ApplicationController::class,'index']);
    
});


