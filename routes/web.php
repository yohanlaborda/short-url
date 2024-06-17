<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShortUrlsController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class);

Route::post('/api/v1/short-urls', ShortUrlsController::class);
