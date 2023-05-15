<?php

use App\Http\Controllers\Api\ConfigController;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\QuestionnaireController;

Route::get('services', [ConfigController::class, 'services']);
Route::get('vehicles', [ConfigController::class, 'vehicles']);
Route::get('countries', [ConfigController::class, 'countries']);
Route::get('booking', [ConfigController::class, 'booking']);

Route::post('questionnaire/order', [QuestionnaireController::class, 'order']);
Route::post('questionnaire/vendor', [QuestionnaireController::class, 'vendor']);

Route::get('pages/{page}', PageController::class);
