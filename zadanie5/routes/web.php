<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalcController;
use App\Http\Controllers\AuthController;

Route::get('/', fn() => redirect('/calc'));

Route::get('/login',   [AuthController::class, 'showLogin']);
Route::post('/login',  [AuthController::class, 'login']);
Route::get('/logout',  [AuthController::class, 'logout']);

Route::get('/calc', [CalcController::class, 'calc']);