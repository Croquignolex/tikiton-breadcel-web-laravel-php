<?php

use App\Models\Order;
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
            'slug' => 'bc2018n57893762',
            'reference' => 'BC2018N57893762',
            'user_id' => 1,
            'discount' => 3
        ]);

        DB::table('orders')->insert([
            'slug' => 'bc2018n54553762',
            'reference' => 'BC2018N54553762',
            'user_id' => 1,
            'discount' => 2,
            'status' => Order::PROGRESS
        ]);

        DB::table('orders')->insert([
            'slug' => 'bc2018n54553736',
            'reference' => 'BC2018N54553736',
            'user_id' => 1,
            'discount' => 1,
            'status' => Order::SOLD
        ]);

        DB::table('orders')->insert([
            'slug' => 'bc2012n54553762',
            'reference' => 'BC2012N54553762',
            'user_id' => 1,
            'discount' => 2,
            'status' => Order::CANCELED
        ]);
    }
}
