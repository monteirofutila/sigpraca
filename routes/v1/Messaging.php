<?php

use App\Http\Controllers\TwilioController;
use Illuminate\Support\Facades\Route;


Route::post('send-message', [TwilioController::class, 'sendMessage']);

