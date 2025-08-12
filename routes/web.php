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

Route::resource('accounts', \App\Http\Controllers\AccountController::class, ['except' => ['store', 'update', 'destroy']]);

Route::group([
    'as' => 'api.',
    'prefix' => 'api/',
    'middleware' => 'auth'
], function () {
    Route::get('transactions/data', [\App\Http\Controllers\Api\TransactionController::class, 'dataTable']);
    Route::resource('transactions', \App\Http\Controllers\Api\TransactionController::class, ['except' => ['show', 'create', 'edit']]);
    Route::post('scheduled-transactions/confirm/{id}', [\App\Http\Controllers\Api\TransactionController::class, 'confirmSheduled']);
});

Route::resource('transactions', \App\Http\Controllers\AccountController::class, ['except' => ['store', 'update', 'destroy']]);

Route::group(
    [
        'as' => 'scheduled-transactions.',
        'prefix' => 'scheduled-transactions/',
        'middleware' => 'auth'
    ],
    function () {
        Route::get('/', [\App\Http\Controllers\TransactionController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\TransactionController::class, 'create'])->name('create');
        Route::get('/{id}/edit', [\App\Http\Controllers\TransactionController::class, 'edit'])->name('edit');
    }
);
