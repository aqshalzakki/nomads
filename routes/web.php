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
Route::get('/logout', function(){
    Auth::logout();
});

Route::get('/detail', function(){
    return view('pages.detail');
})->name('detail');

Route::prefix('checkout')
     ->name('checkout.')
     ->group(function(){

         Route::get('/', 'CheckoutController@index')
             ->name('index');
         Route::get('/success', 'CheckoutController@success')
             ->name('success');
     
       });

// Admin Routes 

    Route::prefix('admin')
    ->name('admin.')
    ->namespace('Admin')
    ->middleware(['verified', 'admin'])
    ->group(function(){
        
        Route::get('/', 'DashboardController@index')->name('dashboard');
        
    });

// End Admin routes 

Auth::routes(['verify' => true]);