<?php

use Illuminate\Support\Facades\Route;
use Modules\Currency\Http\Controllers\CurrencyController;

Route::group([
    // "middleware" => "auth"
], function () {
    Route::group([
        'prefix' => 'currencies/'
    ], function () {
        Route::get("check-code", [\Modules\Currency\Http\Controllers\Api\CurrencyController::class, "checkCode"]);
        Route::get("update-rates", [\Modules\Currency\Http\Controllers\Api\CurrencyController::class, "updateRates"]);
        Route::get('data', [\Modules\Currency\Http\Controllers\Api\CurrencyController::class, 'dataTable']);
    });
    Route::resource('currencies', \Modules\Currency\Http\Controllers\Api\CurrencyController::class, ['except' => ['index', 'create', 'edit']]);
});
