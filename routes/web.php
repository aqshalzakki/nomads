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


Route::get('/', 'HomeController@index')->name('home');

// for testing only
Route::get('/admin/test', 'Admin\TravelPackageController@test');

Route::get('/logout', function(){
    Auth::logout();
});

// Checkout Routes
    Route::prefix('checkout')
        ->name('checkout.')
        ->group(function(){
    
            Route::get('/', 'CheckoutController@index')
            ->name('index');
            Route::get('/success', 'CheckoutController@success')
            ->name('success');
        
        });
        
// Checkout Routes

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