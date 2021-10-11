<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	['created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'name' => '', 'balance' => 0],
        	['created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'name' => '', 'balance' => 0]
    	]);
    }
}
