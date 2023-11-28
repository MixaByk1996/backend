<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return auth()->user();
});

Route::apiResource('city', \App\Http\Controllers\CityController::class);
Route::apiResource('country', \App\Http\Controllers\CountryController::class);
Route::apiResource('access-list', \App\Http\Controllers\AccessListController::class);
Route::apiResource('company', \App\Http\Controllers\CompanyController::class);
Route::apiResource('files', \App\Http\Controllers\FilesController::class);
Route::apiResource('projects', \App\Http\Controllers\ProjectController::class);
Route::apiResource('subprojects', \App\Http\Controllers\SubprojectController::class);
Route::post('/login', [\App\Http\Controllers\UserController::class, 'login']);
Route::post('/register', [\App\Http\Controllers\UserController::class, 'register']);
Route::post('/logout', [\App\Http\Controllers\UserController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/has-address', [\App\Http\Controllers\AccessListController::class, 'hashIpAddress']);
