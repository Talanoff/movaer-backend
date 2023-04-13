<?php

use App\Http\Controllers\Api\ConfigController;

Route::get('services', [ConfigController::class, 'services']);
Route::get('vehicles', [ConfigController::class, 'vehicles']);
Route::get('countries', [ConfigController::class, 'countries']);
Route::get('wishes', [ConfigController::class, 'wishes']);
