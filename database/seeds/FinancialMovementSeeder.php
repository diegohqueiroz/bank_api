<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class FinancialMovementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$date = Carbon::now();
        DB::table('financial_movements')->insert([
        	['created_at' => $date, 'updated_at' => $date, 'bank_account_id' => 1, 'type' =>'in', 'value' => 100, 'previous_balance' => 0 ,'later_balance' => 100],
        	['created_at' => $date, 'updated_at' => $date, 'bank_account_id' => 1, 'type' =>'in', 'value' => 100, 'previous_balance' => 100, 'later_balance' => 200],
        	['created_at' => $date, 'updated_at' => $date, 'bank_account_id' => 1, 'type' =>'out', 'value' => 50, 'previous_balance' => 200, 'later_balance' => 150],
    	]);
    	$balance = DB::table('financial_movements')->insert([
        	['created_at' => $date, 'updated_at' => $date, 'bank_account_id' => 1, 'type' =>'in', 'value' => 100, 'previous_balance' => 0 ,'later_balance' => 100],
        	['created_at' => $date, 'updated_at' => $date, 'bank_account_id' => 1, 'type' =>'in', 'value' => 100, 'previous_balance' => 100, 'later_balance' => 200],
        	['created_at' => $date, 'updated_at' => $date, 'bank_account_id' => 1, 'type' =>'out', 'value' => 50, 'previous_balance' => 200, 'later_balance' => 150],
    	]);
        DB::table('bank_accounts')->where('id', 1)->update([
	    	'updated_at' => $date, 'balance' => 1024
    	]);

        DB::table('financial_movements')->insert([
        	['created_at' => $date, 'updated_at' => $date, 'bank_account_id' => 2, 'type' =>'in', 'value' => 12, 'previous_balance' => 0 ,'later_balance' => 12],
        	['created_at' => $date, 'updated_at' => $date, 'bank_account_id' => 2, 'type' =>'in', 'value' => 1000, 'previous_balance' => 12, 'later_balance' => 1012],
        	['created_at' => $date, 'updated_at' => $date, 'bank_account_id' => 2, 'type' =>'in', 'value' => 8, 'previous_balance' => 1012, 'later_balance' => 1024],
    	]);
        DB::table('bank_accounts')->where('id', 2)->update([
	    	'updated_at' => $date, 'balance' => 1024
    	]);

        DB::table('financial_movements')->insert([
        	['created_at' => $date, 'updated_at' => $date, 'bank_account_id' => 3, 'type' =>'in', 'value' => 2, 'previous_balance' => 0, 'later_balance' => 2],
        	['created_at' => $date, 'updated_at' => $date, 'bank_account_id' => 3, 'type' =>'in', 'value' => 4, 'previous_balance' => 2, 'later_balance' => 6],
        	['created_at' => $date, 'updated_at' => $date, 'bank_account_id' => 3, 'type' =>'in', 'value' => 8, 'previous_balance' => 6, 'later_balance' => 14],
        	['created_at' => $date, 'updated_at' => $date, 'bank_account_id' => 3, 'type' =>'in', 'value' => 16, 'previous_balance' => 14, 'later_balance' => 30],
    	]);
        DB::table('bank_accounts')->where('id', 3)->update([
	    	'updated_at' => $date, 'balance' => 30
    	]);
    }
}
