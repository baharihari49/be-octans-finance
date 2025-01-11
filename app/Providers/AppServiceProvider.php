<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Observers\TransactionsObserver;
use App\Models\Transactions;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Transactions::observe(TransactionsObserver::class);
    }
}
