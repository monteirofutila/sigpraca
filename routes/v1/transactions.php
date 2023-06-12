<?php

use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::post('workers/{workerID}/transactions/credit', [TransactionController::class, 'creditBalance'])->middleware(['auth:sanctum']);
Route::post('workers/{workerID}/transactions/debit', [TransactionController::class, 'debitBalance'])->middleware(['auth:sanctum']);
Route::get('workers/{workerID}/transactions', [TransactionController::class, 'getByWorker'])->middleware(['auth:sanctum']);
Route::get('transactions', [TransactionController::class, 'index'])->middleware(['auth:sanctum']);