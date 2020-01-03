<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', 'ShowHome')->name('home');

// for testing only
Route::get('/admin/test', 'Admin\TravelPackageController@test');
Route::get('/logout', function(){
    Auth::logout();
});

// Detail of Travel Package
    Route::get('travel-packages/{slug}', 'Admin\TravelPackageController@show')->name('travel-packages.detail');
// End Detail

// Checkout Routes
    Route::prefix('checkout')
        ->name('checkout.')
        ->middleware(['verified'])
        ->group(function(){
            
            // PROCESS
            Route::post('/{travelPackage}', 'CheckoutController@process')
                 ->name('process');

            // INDEX
            Route::get('/{transaction}', 'CheckoutController@index')
                 ->name('index');

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
            Route::get('confirm/{transaction}', 'CheckoutController@success')
                 ->name('success')
                 ->middleware('is_in_cart');
        });
        
// End Checkout Routes

// Admin Routes 

    Route::prefix('admin')
        ->name('admin.')
        ->namespace('Admin')
        ->middleware(['verified', 'admin'])
        ->group(function(){
            
            Route::get('/', 'ShowDashboard')->name('index');
            
            Route::resources([
                'travel-packages' => 'TravelPackageController',
                'galleries'       => 'GalleryController',
                'transactions'    => 'TransactionController',
            ]);

        });

// End Admin routes 

Auth::routes(['verify' => true]);