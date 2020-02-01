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

Route::get('/logout', function(){
    auth()->logout();
    return redirect('/login');
});
Route::get('/', 'ShowHome')->name('home');

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

Route::namespace('User')
     ->group(function(){

        Route::get('/travel-packages/c/{category}', 'TravelPackageController@category')->name('travel-packages.category');
        Route::get('/travel-packages/search', 'TravelPackageController@search')->name('travel-packages.search');
        Route::resource('travel-packages', 'TravelPackageController')
             ->only(['index', 'show']);

     });

Route::namespace('User')
     ->name('profile.')
     ->prefix('profile')
     ->middleware(['auth', 'user'])
     ->group(function(){

        Route::get('/', 'ProfileController@index')->name('index');
        Route::patch('/{profile}', 'ProfileController@update')->name('update');
        
        Route::name('password.')
             ->prefix('password')
             ->group(function(){

                  Route::get('/', 'UserPasswordController@edit')->name('edit');
                  Route::post('/check', 'UserPasswordController@checkPassword')->name('check');
                  Route::patch('/update/{user}', 'UserPasswordController@update')->name('update');
                  
               });
});

Auth::routes(['verify' => true]);