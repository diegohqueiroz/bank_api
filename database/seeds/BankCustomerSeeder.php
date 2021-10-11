<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class BankCustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$date = Carbon::now();
        DB::table('bank_customers')->insert([
        	['created_at' => $date, 'updated_at' => $date, 'name' => 'Carolina Maria de Jesus', 'bank_id' => 1],
        	['created_at' => $date, 'updated_at' => $date, 'name' => 'Albert Einstein', 'bank_id' => 1],
        	['created_at' => $date, 'updated_at' => $date, 'name' => 'Augustus Nicodemus', 'bank_id' => 1],
    	]);
    }
}
