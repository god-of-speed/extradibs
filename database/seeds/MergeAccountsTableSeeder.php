<?php

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;

class MergeAccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //initialize packages
        DB::table('merge_accounts')->insert([
            'name'=>'current',
            'number' => 0,
            'startDate'=>Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
