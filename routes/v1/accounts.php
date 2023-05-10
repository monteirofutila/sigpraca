<?php

use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;

Route::get('workers/{workerID}/accounts', [AccountController::class, 'findByWorker'])->middleware(['auth:sanctum']);