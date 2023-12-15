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
//header('Access-Control-Allow-Origin: *');
//header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
//header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept, Authorization, X-CSRF-Token");

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return auth()->user();
});

Route::apiResource('city', \App\Http\Controllers\CityController::class);
Route::apiResource('country', \App\Http\Controllers\CountryController::class);
Route::apiResource('access-list', \App\Http\Controllers\AccessListController::class);
Route::get('access-list/delete/{id}', [\App\Http\Controllers\AccessListController::class, 'deleteById']);
Route::apiResource('company', \App\Http\Controllers\CompanyController::class);
Route::apiResource('files', \App\Http\Controllers\FilesController::class);
Route::apiResource('projects', \App\Http\Controllers\ProjectController::class);
Route::apiResource('subprojects', \App\Http\Controllers\SubprojectController::class);
Route::apiResource('users', \App\Http\Controllers\UserController::class);
Route::apiResource('backup', \App\Http\Controllers\BackupController::class);
Route::apiResource('tags', \App\Http\Controllers\TagController::class);
Route::post('update-project/{id}', [\App\Http\Controllers\ProjectController::class, 'getUpdate']);
Route::post('add-files-to-project/{id}', [\App\Http\Controllers\ProjectController::class, 'addFileInProject']);
Route::post('add-files-to-subproject/{id}', [\App\Http\Controllers\SubprojectController::class, 'addFileInSubProject']);
Route::post('/login', [\App\Http\Controllers\UserController::class, 'login']);
Route::post('/download-pdf', [\App\Http\Controllers\BackupController::class, 'getPdf']);
Route::post('/register', [\App\Http\Controllers\UserController::class, 'register']);
Route::post('/logout', [\App\Http\Controllers\UserController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/has-address', [\App\Http\Controllers\AccessListController::class, 'hashIpAddress']);
Route::get('/add-ip', [\App\Http\Controllers\AccessListController::class, 'addIpAddress']);
