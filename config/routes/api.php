<?php

use Illuminate\Support\Facades\Route;
use Lazysoft\Wufor\Http\Controllers\BotController;

Route::post("bot{token}", BotController::class);
