<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;



Route::get('/', [HomeController::class, 'index']);
Route::get('/{USER}', [HomeController::class, 'getUser']);
