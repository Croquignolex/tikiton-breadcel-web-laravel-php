<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert([
            'slug' => 'bc181',
            'reference' => 'BC181',
            'user_id' => 1,
            'coupon_id' => 1,
        ]);

        DB::table('orders')->insert([
            'slug' => 'bc182',
            'reference' => 'BC182',
            'user_id' => 1,
            'status' => 1,
            'coupon_id' => 2,
        ]);

        DB::table('orders')->insert([
            'slug' => 'bc183',
            'reference' => 'BC183',
            'user_id' => 1,
            'status' => 2,
            'coupon_id' => 1,
        ]);
    }
}
