<?php

namespace App\Providers\User;

use Illuminate\Support\ServiceProvider;

use App\User;
use App\Observers\UserObserver;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        User::observe(UserObserver::class);

        view()->composer([

            // What views should be shared with some data
            'components.user.navbar',
            'user.profiles.index',
            'user.checkout.index',
            
        ],  
            // What data should be shared...
            function($view){
            $userCache = cache()->remember('user', now()->addMonths(1), function(){
                            return auth()->user();
                        });

            $view->with('user', $userCache);
        });
    }
}
