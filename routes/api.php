<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/registration', [AuthController::class, 'register']);
Route::middleware('auth:sanctum')->get('/profile', [AuthController::class, 'profile']);
