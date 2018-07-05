<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserCouponsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_coupons')->insert([
            'user_id' => 1,
            'coupon_id' => 1
        ]);

        DB::table('user_coupons')->insert([
            'user_id' => 1,
            'coupon_id' => 2
        ]);
    }
}
