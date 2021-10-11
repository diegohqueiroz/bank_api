<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class BankAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$date = Carbon::now();
        DB::table('bank_accounts')->insert([
        	['created_at' => $date, 'updated_at' => $date, 'number' => 314159265, 'balance' => 0, 'bank_customer_id' => 1, 'active' => true, 'agency' => '456'],
        	['created_at' => $date, 'updated_at' => $date, 'number' => 789456123, 'balance' => 0, 'bank_customer_id' => 2, 'active' => true, 'agency' => '789'],
        	['created_at' => $date, 'updated_at' => $date, 'number' => 987654321, 'balance' => 0, 'bank_customer_id' => 3, 'active' => true, 'agency' => '789'],
        	['created_at' => $date, 'updated_at' => $date, 'number' => 654321987, 'balance' => 0, 'bank_customer_id' => 3, 'active' => false, 'agency' => '789'],
    	]);
    }
}
