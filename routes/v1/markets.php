<?php

use App\Http\Controllers\MarketController;
use Illuminate\Support\Facades\Route;

Route::get('market', [MarketController::class, 'show'])->middleware(['auth:sanctum']);
Route::put('market', [MarketController::class, 'update'])->middleware(['auth:sanctum']);