<?php

use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\ContactMessageController;
use App\Http\Controllers\Api\ClientLogoController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\VideoController;
use Illuminate\Support\Facades\Route;

Route::apiResource('blogs', BlogController::class)->only(['index', 'show']);
Route::apiResource('reviews', ReviewController::class)->only(['index', 'show']);
Route::apiResource('client-logos', ClientLogoController::class)->only(['index', 'show']);
Route::apiResource('videos', VideoController::class)->only(['index', 'show']);
Route::post('contact-messages', [ContactMessageController::class, 'store'])->name('api.contact-messages.store');
