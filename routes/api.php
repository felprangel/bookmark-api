<?php

use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [UsersController::class, 'createUser']);
Route::post('/login', [UsersController::class, 'login']);
Route::post('/logout', [UsersController::class, 'logout']);
