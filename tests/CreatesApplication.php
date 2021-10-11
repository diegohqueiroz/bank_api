<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;
use App\Models\BankAccount;
use App\Models\FinancialMovement;
use App\Repositories\BaseRepository;
use App\Repositories\BankAccountRepository;
use App\Repositories\FinancialMovementRepository;

trait CreatesApplication
{
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        app()->singleton(BankAccountRepository::class, function ($app) {
           return new BankAccountRepository($app->make(BankAccount::class));
        });
        app()->singleton(FinancialMovementRepository::class, function ($app) {
            return new FinancialMovementRepository($app->make(FinancialMovement::class));
        });
        //$app->singleton(BankAccountRepository::class, function ($app) {
        //    return new BankAccountRepository($app->make(BankAccount::class));
        //});
        //$app->singleton(FinancialMovementRepository::class, function ($app) {
        //    return new FinancialMovementRepository($app->make(FinancialMovement::class));
        //});
        //$app->bind(ClientContract::class, function() {
        //    return new Services\Boletos\Client('ABC123');
        //});

        //$app->make(BankService::class);

        return $app;
    }
}
