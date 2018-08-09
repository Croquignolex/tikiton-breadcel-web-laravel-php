<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CouponsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('coupons')->insert([
            'code' => 'BC2012C54553762',
            'discount' => 5,
            'description' => 'description',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('coupons')->insert([
            'code' => 'BC2012C54773762',
            'discount' => 10,
            'description' => 'description',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}