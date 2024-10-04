<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NovelController;
Route::get('/', function () {
    return view('welcome');
});

Route::resource('novels', NovelController::class);
