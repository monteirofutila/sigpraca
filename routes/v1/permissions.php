<?php

use App\Http\Controllers\PermissionController;
use Illuminate\Support\Facades\Route;

Route::get('roles', [PermissionController::class, 'getAllRoles'])->middleware(['auth:sanctum']);
Route::get('users/{userID}/permissions', [PermissionController::class, 'getPermissions'])->middleware(['auth:sanctum']);
Route::get('users/{userID}/roles', [PermissionController::class, 'getRoles'])->middleware(['auth:sanctum']);