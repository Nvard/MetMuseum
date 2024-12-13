<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MetMuseumController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/departments', [MetMuseumController::class, 'getDepartments']);
Route::get('/search', [MetMuseumController::class, 'searchArtworks']);
