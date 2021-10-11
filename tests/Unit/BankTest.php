<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\BankAccount;
use App\Models\FinancialMovement;
use App\Services\BankService;
use App\Repositories\BaseRepository;
use App\Repositories\BankAccountRepository;
use App\Repositories\FinancialMovementRepository;
use Illuminate\Container\Container as Container;
use Illuminate\Support\Facades\Facade as Facade;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

//use Log;

class BankTest extends TestCase
{

	//use DatabaseTransactions;

    protected $bankService;

    protected function setUp(): void
    {
        parent::setUp();
       	app()->singleton(BankAccountRepository::class, function ($app) {
        	return new BankAccountRepository($app->make(BankAccount::class));
       	});
       	app()->singleton(FinancialMovementRepository::class, function ($app) {
           	return new FinancialMovementRepository($app->make(FinancialMovement::class));
       	});

        $this->bankService = app()->make(BankService::class);
    }

    /**
     * Escrevi alguns testes
     *
     * @return void
     */
    public function testPrepareDataMovement()
    {
	    $data = ['movement' => 'in', 'value' => 10];
	    $old = 0;
        $data = $this->bankService->prepareDataMovement($data, $old);
        $this->assertEquals(0, $data['previous_balance']);
        $this->assertEquals(10, $data['later_balance']);        

	    $data = ['movement' => 'in', 'value' => 255];
	    $old = 250;
        $data = $this->bankService->prepareDataMovement($data, $old);
        $this->assertEquals(250, $data['previous_balance']);
        $this->assertEquals(505, $data['later_balance']);        

	    $data = ['movement' => 'out', 'value' => 80];
	    $old = 160;
        $data = $this->bankService->prepareDataMovement($data, $old);
        $this->assertEquals(160, $data['previous_balance']);
        $this->assertEquals(80, $data['later_balance']);        

	    $data = ['movement' => 'out', 'value' => 150];
	    $old = 450;
        $data = $this->bankService->prepareDataMovement($data, $old);
        $this->assertEquals(450, $data['previous_balance']);
        $this->assertEquals(300, $data['later_balance']);        
    }
}
