<?php

use App\Http\Controllers\UserController;
use App\Http\Middleware\OnlyGuestMiddleware;
use App\Http\Middleware\OnlyMemberMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/template', 'template');

Route::controller(UserController::class)->group(function () {
    Route::get('/login', [UserController::class,'login'])->middleware([OnlyGuestMiddleware::class]);
    Route::post('/login', [UserController::class,'doLogin'])->middleware(OnlyGuestMiddleware::class);
    Route::post('/logout', [UserController::class,'doLogout'])->middleware(OnlyMemberMiddleware::class);
});