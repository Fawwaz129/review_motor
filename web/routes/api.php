<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MotorController;
use App\Http\Controllers\AuthenticationController;

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
    return $request->user();
});
Route::get('/posts', [MotorController::class, 'index'])->middleware(['auth:sanctum']);
Route::get('/posts/{id}', [MotorController::class, 'show'])->middleware(['auth:sanctum']);
Route::get('/posts2/{id}', [MotorController::class, 'show2']);
Route::post('/login', [AuthenticationController::class, 'login']);
Route::get('/logout', [AuthenticationController::class, 'logout'])->middleware('auth:sanctum');
