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
            'user.profiles.card',
            'user.checkout.index',
            'user.password.edit',

        ],
            // What data should be shared...
            function($view){
            $userCache = rememberUserCache();

            $view->with('user', $userCache);
        });
    }
}
