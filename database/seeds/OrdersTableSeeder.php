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
            'slug' => 'bc2018o57893762',
            'reference' => 'BC2018O57893762',
            'user_id' => 1,
            'discount' => 3,
            'shipping_address' => 'Ville Marie',
            'shipping_post_code' => '200',
            'shipping_city' => 'Quebec',
            'shipping_country' => 'Canada'
        ]);

        DB::table('orders')->insert([
            'slug' => 'bc2018o54553762',
            'reference' => 'BC2018O54553762',
            'user_id' => 1,
            'discount' => 2,
            'status' => Order::PROGRESS,
            'shipping_address' => 'Ville Marie',
            'shipping_post_code' => '400',
            'shipping_city' => 'Toronto',
            'shipping_country' => 'Canada'
        ]);

        DB::table('orders')->insert([
            'slug' => 'bc2018o54553736',
            'reference' => 'BC2018O54553736',
            'user_id' => 1,
            'discount' => 1,
            'status' => Order::SOLD,
            'shipping_address' => 'Ville Marie',
            'shipping_post_code' => '600',
            'shipping_city' => 'New Bork',
            'shipping_country' => 'Canada'
        ]);

        DB::table('orders')->insert([
            'slug' => 'bc2012o54553762',
            'reference' => 'BC2012O54553762',
            'user_id' => 1,
            'discount' => 2,
            'status' => Order::CANCELED,
            'shipping_address' => 'Cite cicam',
            'shipping_post_code' => '300',
            'shipping_city' => 'Douala',
            'shipping_country' => 'Cameroun'
        ]);
    }
}
