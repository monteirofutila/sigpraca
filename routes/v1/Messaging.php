<?php

use App\Http\Controllers\MessagingController;
use Illuminate\Support\Facades\Route;


Route::post('send-message', [MessagingController::class, 'sendMessage']);

