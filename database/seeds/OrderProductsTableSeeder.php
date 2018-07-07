<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_products')->insert([
            'quantity' => 5,
            'order_id' => 1,
            'product_id' => 1
        ]);

        DB::table('order_products')->insert([
            'quantity' => 7,
            'order_id' => 1,
            'product_id' => 2
        ]);

        DB::table('order_products')->insert([
            'quantity' => 6,
            'order_id' => 1,
            'product_id' => 3
        ]);

        DB::table('order_products')->insert([
            'quantity' => 14,
            'order_id' => 2,
            'product_id' => 6
        ]);

        DB::table('order_products')->insert([
            'quantity' => 3,
            'order_id' => 2,
            'product_id' => 7
        ]);

        DB::table('order_products')->insert([
            'quantity' => 9,
            'order_id' => 2,
            'product_id' => 4
        ]);

        DB::table('order_products')->insert([
            'quantity' => 2,
            'order_id' => 3,
            'product_id' => 1
        ]);

        DB::table('order_products')->insert([
            'quantity' => 3,
            'order_id' => 3,
            'product_id' => 9
        ]);

        DB::table('order_products')->insert([
            'quantity' => 15,
            'order_id' => 3,
            'product_id' => 6
        ]);

        DB::table('order_products')->insert([
            'quantity' => 2,
            'order_id' => 4,
            'product_id' => 4
        ]);

        DB::table('order_products')->insert([
            'quantity' => 5,
            'order_id' => 4,
            'product_id' => 7
        ]);
    }
}
