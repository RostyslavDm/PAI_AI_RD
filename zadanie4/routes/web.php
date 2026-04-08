<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalcController;

Route::get('/', [CalcController::class, 'index']);
Route::get('/calc', [CalcController::class, 'calc']);