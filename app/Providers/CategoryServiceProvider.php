<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Category;

class CategoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer([

            // What views should be shared with some data
            'user.travel-packages.index',
            'admin.travel-packages.create',
            'admin.travel-packages.edit',
        ],  
            // What data should be shared...
            function($view){

            $categories = Category::all();
            $view->with('categories', $categories);
        });
    }
}
