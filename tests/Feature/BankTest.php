<?php

namespace Tests\Feature;

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

    public function testBalance()
    {
        $balance = $this->bankService->getBalance(1);
		$this->assertEquals(300 ,$balance->balance);

        $balance = $this->bankService->getBalance(2);
		$this->assertEquals(1020 ,$balance->balance);

        $balance = $this->bankService->getBalance(3);
		$this->assertEquals(30 ,$balance->balance);
    }

    public function testApi()
    {
        $response = $this->get('/api/bank/accounts/1/balance');
        $data = json_decode($response->content());
        $this->assertEquals(300, $data->balance);

        $response = $this->get('/api/bank/accounts/2/balance');
        $data = json_decode($response->content());
        $this->assertEquals(1020, $data->balance);

        $response = $this->get('/api/bank/accounts/3/balance');
        $data = json_decode($response->content());
        $this->assertEquals(30, $data->balance);

        $response = $this->get('/api/bank/accounts/1');
        $response->assertJsonStructure([
            'id','number', 'agency', 'customer' => [ 'id' , 'name'], 'bank' => ['name']
        ]);
        $data = $response->content();
        $this->assertEquals('{"id":1,"number":"314159265","agency":"456","active":"1","customer":{"id":1,"name":"Carolina Maria de Jesus"},"bank":{"name":"Capgemini Bank"}}', $data);
        
        $response = $this->put('/api/bank/accounts/1/movement', [
            'movement' => 'in',
            'value' => 50,
            'bank_account_id' => 1,
        ]);
        $data = json_decode($response->content());
        $this->assertTrue($data->sucess);

        $response = $this->get('/api/bank/accounts/1/balance');
        $data = json_decode($response->content());
        $this->assertEquals(350, $data->balance);

        $response = $this->put('/api/bank/accounts/1/movement', [
            'movement' => 'out',
            'value' => 500,
            'bank_account_id' => 1,
        ]);
        $data = json_decode($response->content());
        $response->assertStatus(422);

        $response = $this->get('/api/bank/accounts/1/balance');
        $data = json_decode($response->content());
        $this->assertEquals(350, $data->balance);
    }
}
