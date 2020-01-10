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
// Route::get('/admin/test', 'Admin\TravelPackageController@test');

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

// User Routes

Route::name('profile.')
     ->prefix('profile')
     ->middleware(['auth'])
     ->group(function(){

        Route::get('/', 'ProfileController@index')->name('index');
        Route::patch('/{profile}', 'ProfileController@update')->name('update');

});

Route::get('/logout', 'Auth\\LoginController@logout');
Auth::routes(['verify' => true]);