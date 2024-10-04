<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NovelController;

// Define the routes for the API
Route::apiResource('novels', NovelController::class);
