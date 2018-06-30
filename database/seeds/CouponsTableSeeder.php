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
            'code' => 'OH69HGH9',
            'discount' => 5,
            'description' => 'description'
        ]);

        DB::table('coupons')->insert([
            'code' => 'BREADCEL',
            'discount' => 10,
            'description' => 'description'
        ]);
    }
}