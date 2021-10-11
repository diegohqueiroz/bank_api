<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\BankAccount;
use App\Models\FinancialMovement;
use App\Repositories\BaseRepository;
use App\Repositories\BankAccountRepository;
use App\Repositories\FinancialMovementRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(BankAccountRepository::class, function ($app) {
            return new BankAccountRepository($app->make(BankAccount::class));
        });
        $this->app->singleton(FinancialMovementRepository::class, function ($app) {
            return new FinancialMovementRepository($app->make(FinancialMovement::class));
        });
        //$this->app->singleton(BankService::class, function ($app) {
        //    return new BankService(FinancialMovementRepository::class, FinancialMovement::class));
        //});
        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
