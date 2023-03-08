<?php

if (App::isLocal()) {
    Route::any('dd', static function () {
        return \App\Models\Vendor::withCount('feedback')->get();
    });
}
