<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RatingController;
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


Route::get('/posts2/{id}', [MotorController::class, 'show2']);
Route::post('/login', [AuthenticationController::class, 'login']);
Route::post('/register', [AuthenticationController::class, 'register']);


Route::middleware(['auth:sanctum'])->group(function (){
    Route::get('/motor', [MotorController::class, 'index']);
    Route::get('/motor/{id}', [MotorController::class, 'show']);
    Route::post('/motor', [MotorController::class, 'store']);
    Route::patch('/motor/{id}', [MotorController::class, 'update'])->middleware(['post.owner']);
    Route::delete('/motor/{id}', [MotorController::class, 'delete'])->middleware(['post.owner']);

    Route::post('/rating', [RatingController::class, 'store']);
    Route::patch('/rating/{id}', [RatingController::class, 'update'])->middleware('rating.owner');
    Route::delete('/rating/{id}', [RatingController::class, 'delete'])->middleware('rating.owner');

    Route::get('/logout', [AuthenticationController::class, 'logout']);
    Route::get('/me', [AuthenticationController::class, 'me']);

});
