<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserWishListsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_wish_lists')->insert([
            'user_id' => 1,
            'product_id' => 1
        ]);

        DB::table('user_wish_lists')->insert([
            'user_id' => 1,
            'product_id' => 2
        ]);

        DB::table('user_wish_lists')->insert([
            'user_id' => 1,
            'product_id' => 7
        ]);

        DB::table('user_wish_lists')->insert([
            'user_id' => 1,
            'product_id' => 5
        ]);

        DB::table('user_wish_lists')->insert([
            'user_id' => 2,
            'product_id' => 1
        ]);

        DB::table('user_wish_lists')->insert([
            'user_id' => 2,
            'product_id' => 2
        ]);
    }
}
