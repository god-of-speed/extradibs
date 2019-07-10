<?php

use Illuminate\Database\Seeder;

class PackagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //initialize packages
        DB::table('packages')->insert([
            'name' => 'Citizen',
            'price' => 2000,
            'description' => "Reward one of our users with 2000 naira and get rewarded by two of our other users to get 200% of your initial contribution.",
            'image' => "images/packages/2000.png",
            'created_at' => new Datetime('now'),
            'updated_at' => new Datetime('now')
        ]);

        DB::table('packages')->insert([
            'name' => 'Economy',
            'price' => 5000,
            'description' => "Reward one of our users with 5000 naira and get rewarded by two of our other users to get 200% of your initial contribution.",
            'image' => "images/packages/5000.png",
            'created_at' => new Datetime('now'),
            'updated_at' => new Datetime('now')
        ]);

        DB::table('packages')->insert([
            'name' => 'Elite',
            'price' => 10000,
            'description' => "Reward one of our users with 10000 naira and get rewarded by two of our other users to get 200% of your initial contribution.",
            'image' => "images/packages/10000.png",
            'created_at' => new Datetime('now'),
            'updated_at' => new Datetime('now')
        ]);
    }
}
