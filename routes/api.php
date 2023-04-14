<?php

use App\Http\Controllers\Api\ConfigController;
use App\Http\Controllers\Api\PageController;

Route::get('services', [ConfigController::class, 'services']);
Route::get('vehicles', [ConfigController::class, 'vehicles']);
Route::get('countries', [ConfigController::class, 'countries']);
Route::get('wishes', [ConfigController::class, 'wishes']);
Route::get('pages/{page}', [PageController::class, 'show']);
