<?php

Route::prefix('admin')
    ->name('admin.')
    ->namespace('Admin')
    ->middleware(['verified', 'admin'])
    ->group(function () {

        Route::get('/', 'ShowDashboard')->name('index');

        Route::resources([
            'travel-packages' => 'TravelPackageController',
            'galleries'       => 'GalleryController',
            'transactions'    => 'TransactionController',
        ]);
    });
