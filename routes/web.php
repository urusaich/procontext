<?php

use App\Http\Controllers\LinkController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/{model}', [LinkController::class, 'go']);
