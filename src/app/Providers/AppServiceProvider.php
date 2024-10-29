<?php

namespace App\Providers;

use App\Services\Deposit\DepositReader;
use App\Services\Deposit\IDepositReader;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IDepositReader::class,DepositReader::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        //
    }
}
