<?php

use App\Http\Controllers\MarketController;
use Illuminate\Support\Facades\Route;

Route::get('markets', [MarketController::class, 'show']);
Route::put('markets', [MarketController::class, 'update']);