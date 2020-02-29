<?php

// User Routes
Route::namespace('User')
    ->group(function () {

        Route::get('/travel-packages/category/{category}', 'TravelPackageController@category')->name('travel-packages.category');
        Route::get('/travel-packages/search', 'TravelPackageController@search')->name('travel-packages.search');
        Route::resource('travel-packages', 'TravelPackageController')
            ->only(['index', 'show']);
    });

Route::namespace('User')
    ->name('profile.')
    ->prefix('profile')
    ->middleware(['auth', 'user'])
    ->group(function () {

        Route::get('/', 'ProfileController@index')->name('index');
        Route::patch('/{profile}', 'ProfileController@update')->name('update');
        Route::put('/{user}/verify-token', 'ProfileController@verifyToken')->name('token');

        Route::name('password.')
            ->prefix('password')
            ->group(function () {

                Route::get('/', 'UserPasswordController@edit')->name('edit');
                Route::post('/check', 'UserPasswordController@checkPassword')->name('check');
                Route::patch('/update/{user}', 'UserPasswordController@update')->name('update');
            });
    });
