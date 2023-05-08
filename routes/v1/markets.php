<?php

use App\Http\Controllers\MarketController;
use Illuminate\Support\Facades\Route;

Route::get('markets', [MarketController::class, 'show'])->middleware(['auth:sanctum']);
;
Route::put('markets', [MarketController::class, 'update'])->middleware(['auth:sanctum']);
;