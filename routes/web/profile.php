<?php

use App\Http\Controllers\Auth\ProfileController;

Route::get('', [ProfileController::class, 'edit'])->name('edit');
Route::patch('', [ProfileController::class, 'update'])->name('update');
Route::delete('', [ProfileController::class, 'destroy'])->name('destroy');
