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

// Travel Packages for user 

    Route::prefix('travel-package')
        ->name('travel-package.')
        ->namespace('Admin')
        ->group(function(){

            Route::get('{travelPackage}', 'TravelPackageController@show')->name('show');

        });

// End Travel Packages 

// Admin Routes 

    Route::prefix('admin')
        ->name('admin.')
        ->namespace('Admin')
        ->middleware(['verified', 'admin'])
        ->group(function(){
            
            Route::get('/', 'DashboardController@index')->name('index');
            
            Route::prefix('travel-package')
                ->name('travel-package.')
                ->group(function(){
                    Route::get('/', 'TravelPackageController@index')->name('index');
                    Route::get('create', 'TravelPackageController@create')->name('create');
                    Route::get('edit/{id}', 'TravelPackageController@edit')->name('edit');
                    Route::post('/', 'TravelPackageController@store')->name('store');
                    Route::delete('/', 'TravelPackageController@destroy')->name('destroy');
                });

        });

// End Admin routes 

Auth::routes(['verify' => true]);