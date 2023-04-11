<?php

use App\Http\Controllers\Api\ConfigController;

Route::get('config', ConfigController::class);

Route::group([
    'middleware' => ['auth:sanctum'],
], static function () {
    //
});
