<?php

use App\Http\Controllers\LinkController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'links'], function() {
    Route::post('/', [LinkController::class, 'store']);
    Route::get('/{model}/stats', [LinkController::class, 'stats']);
});
