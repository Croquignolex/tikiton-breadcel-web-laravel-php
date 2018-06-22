<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserCartsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_carts')->insert([
            'user_id' => 1,
            'product_id' => 1,
            'quantity' => 1
        ]);

        DB::table('user_carts')->insert([
            'user_id' => 1,
            'product_id' => 2,
            'quantity' => 5
        ]);

        DB::table('user_carts')->insert([
            'user_id' => 2,
            'product_id' => 1,
            'quantity' => 3
        ]);

        DB::table('user_carts')->insert([
            'user_id' => 2,
            'product_id' => 2,
            'quantity' => 2
        ]);
    }
}
