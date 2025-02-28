<?php

use App\Http\Controllers\UsersController;
use Illuminate\Routing\Route;

Route::post('/register', [UsersController::class, 'createUser']);
