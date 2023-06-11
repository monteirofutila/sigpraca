<?php

use App\Http\Controllers\MarketController;
use Illuminate\Support\Facades\Route;

Route::get('market', [MarketController::class, 'show']);
Route::post('market', [MarketController::class, 'update'])->middleware(['auth:sanctum']);