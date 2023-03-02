<?php

if (App::isLocal()) {
    Route::any('dd', function () {
        return \App\Models\Vendor::withCount('feedback')->get();
    });
}

Route::as('client:')->group(base_path('routes/web/client.php'));

Route::as('auth:')->group(base_path('routes/web/auth.php'));
Route::as('auth:profile.')
    ->prefix('profile')
    ->middleware('auth')
    ->group(base_path('routes/web/profile.php'));
