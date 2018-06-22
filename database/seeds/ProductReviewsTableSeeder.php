<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_reviews')->insert([
            'text' => 'review 1',
            'ranking' => 10,
            'product_id' => 1,
            'user_id' => 1,
            'created_at' => now(),
        ]);

        DB::table('product_reviews')->insert([
            'text' => 'review 2',
            'ranking' => 10,
            'product_id' => 2,
            'user_id' => 2,
            'created_at' => now(),
        ]);
    }
}
