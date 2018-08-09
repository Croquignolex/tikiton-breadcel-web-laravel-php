<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_tags')->insert([
            'product_id' => '1',
            'tag_id' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('product_tags')->insert([
            'product_id' => '1',
            'tag_id' => '2',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('product_tags')->insert([
            'product_id' => '1',
            'tag_id' => '3',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('product_tags')->insert([
            'product_id' => '1',
            'tag_id' => '4',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('product_tags')->insert([
            'product_id' => '1',
            'tag_id' => '5',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('product_tags')->insert([
            'product_id' => '2',
            'tag_id' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('product_tags')->insert([
            'product_id' => '3',
            'tag_id' => '2',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('product_tags')->insert([
            'product_id' => '4',
            'tag_id' => '3',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('product_tags')->insert([
            'product_id' => '5',
            'tag_id' => '4',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('product_tags')->insert([
            'product_id' => '6',
            'tag_id' => '5',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
