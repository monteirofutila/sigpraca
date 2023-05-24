<?php

use App\Http\Controllers\StatistController;
use Illuminate\Support\Facades\Route;

Route::get('statist', [StatistController::class, 'stast'])->middleware(['auth:sanctum']);