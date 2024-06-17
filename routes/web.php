<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShortUrlsController;
use App\Http\Middleware\CustomBearerApiToken;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class);

Route::middleware([CustomBearerApiToken::class])->group(
    static function () {
        Route::post('/api/v1/short-urls', ShortUrlsController::class);
    }
);

