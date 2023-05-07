<?php

use App\Http\Controllers\WorkerController;
use Illuminate\Support\Facades\Route;

Route::apiResource('workers', WorkerController::class);