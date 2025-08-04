<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'as' => 'api.',
    'prefix' => 'api/',
    'middleware' => 'auth'
], function () {
    Route::get('accounts/data', [\App\Http\Controllers\Api\AccountController::class, 'dataTable']);
    Route::resource('accounts', \App\Http\Controllers\Api\AccountController::class);
});

Route::resource('accounts', \App\Http\Controllers\AccountController::class);
