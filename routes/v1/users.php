<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::apiResource('users', UserController::class)->middleware(['auth:sanctum'])->except('update');
Route::post('users/{userID}', [UserController::class, 'update'])->middleware(['auth:sanctum'])->name('workers.update');