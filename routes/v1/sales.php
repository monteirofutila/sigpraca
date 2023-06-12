<?php

use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;

Route::get('sales/{startDate}/{lastDate}', [SaleController::class, 'saleByPeriod'])->middleware(['auth:sanctum']);