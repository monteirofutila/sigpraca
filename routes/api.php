<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

require base_path('routes/v1/auth.php');
require base_path('routes/v1/users.php');
require base_path('routes/v1/workers.php');
require base_path('routes/v1/transactions.php');
require base_path('routes/v1/markets.php');
require base_path('routes/v1/accounts.php');
require base_path('routes/v1/permissions.php');