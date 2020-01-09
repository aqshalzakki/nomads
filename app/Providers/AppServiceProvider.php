<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use App\Transaction;
use App\Observers\TransactionObserver;

use App\User;
use App\Observers\UserObserver;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(120);
        Transaction::observe(TransactionObserver::class);
        User::observe(UserObserver::class);
    }
}
