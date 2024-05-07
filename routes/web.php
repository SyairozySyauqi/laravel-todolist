<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/template', 'template');

Route::controller(UserController::class)->group(function () {
    Route::get('/login', [UserController::class,'login']);
    Route::post('/login', [UserController::class,'doLogin']);
    Route::post('/logout', [UserController::class,'doLogout']);
});