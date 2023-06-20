<?php

use App\Http\Controllers\WorkerController;
use Illuminate\Support\Facades\Route;

Route::apiResource('workers', WorkerController::class)->middleware(['auth:sanctum'])->except('update');
Route::post('workers/{workerID}', [WorkerController::class, 'update'])->middleware(['auth:sanctum'])->name('workers.update');