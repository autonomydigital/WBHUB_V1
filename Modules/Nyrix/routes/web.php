<?php

use Illuminate\Support\Facades\Route;
use Modules\Nyrix\Http\Controllers\NyrixController;

/*
|--------------------------------------------------------------------------
| 🌌 Nyrix Module Routes
|--------------------------------------------------------------------------
| All routes here are prefixed with "/nyrix" and require authentication.
| This module powers the AI assistant across the platform.
| Now protected with custom godmode middleware.
*/

Route::middleware(['web', 'auth', 'godmode'])
    ->prefix('nyrix')
    ->name('nyrix.')
    ->group(function () {

    Route::get('/', [NyrixController::class, 'index'])->name('index');
    Route::post('/ask', [NyrixController::class, 'ask'])->name('ask');
    Route::get('/toggle', [NyrixController::class, 'toggleView'])->name('toggle');
    Route::post('/toggle', [NyrixController::class, 'toggle'])->name('toggle.update');
    Route::get('/godmode', [NyrixController::class, 'godModePanel'])->name('godmode.panel');

    // 🔧 This now fits inside the same group
    Route::post('/execute', [NyrixController::class, 'execute'])->name('execute');
    Route::post('/ask', [NyrixController::class, 'ask'])->name('ask');
});