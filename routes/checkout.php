<?php

// Checkout Routes
Route::prefix('checkout')
    ->name('checkout.')
    ->middleware(['verified'])
    ->group(function () {

    // PROCESS
    Route::post('/{travelPackage}', 'CheckoutController@process')
        ->name('process');

    // INDEX
    Route::get('/{id}', 'CheckoutController@index')
        ->name('index')
        ->middleware('is_in_cart');

    // SET TRANSACTION STATUS TO CANCEL
    Route::post('/cancel/{transaction}', 'CheckoutController@cancel')
        ->name('destroy');

    // CREATE TRANSACTION DETAIL
    Route::post('/create/{transaction}', 'CheckoutController@create')
        ->name('create');

    // REMOVE TRANSACTION DETAIL
    Route::delete('/remove/{transactionDetail}', 'CheckoutController@remove')
        ->name('remove');

    // SUCCESS
    Route::get('confirm/{id}', 'CheckoutController@success')
        ->name('success')
        ->middleware('is_pending');
});
