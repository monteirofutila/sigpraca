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
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MarketController;
require __DIR__ . '/routes/UserRoute.php';
require __DIR__ . '/routes/WorkerRoute.php';

Route::resource('categorys', CategoryController::class);

Route::resource('market', MarketController::class);
/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */
