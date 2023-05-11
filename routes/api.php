<?php

use App\Http\Controllers\Api\ConfigController;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\QuestionnaireController;

Route::get('services', [ConfigController::class, 'services']);
Route::get('vehicles', [ConfigController::class, 'vehicles']);
Route::get('countries', [ConfigController::class, 'countries']);
Route::get('wishes', [ConfigController::class, 'wishes']);

Route::post('questionnaire/customer', [QuestionnaireController::class, 'customer']);
Route::post('questionnaire/vendor', [QuestionnaireController::class, 'vendor']);

Route::get('pages/{page}', PageController::class);
