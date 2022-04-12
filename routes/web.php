<?php

use Illuminate\Support\Facades\Route;
use StarfolkSoftware\Levy\Http\Controllers\TaxController;

Route::group([
    'middleware' => config('levy.middleware', ['web']),
], function () {
    Route::resource('taxes', TaxController::class)->only(['store', 'update', 'destroy']);
});