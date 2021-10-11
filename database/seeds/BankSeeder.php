<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$date = Carbon::now();
        DB::table('banks')->insert([
        	['created_at' => $date, 'updated_at' => $date, 'name' => 'Capgemini Bank']
    	]);
    }
}
