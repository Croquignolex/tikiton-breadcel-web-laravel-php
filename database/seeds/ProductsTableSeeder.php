<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'slug' => 'pastry_1',
            'image' => 'product_1',
            'fr_name' => 'Pâtisserie 1',
            'en_name' => 'Pastry 1',
            'fr_featured_title' => null,
            'en_featured_title' => null,
            'fr_description' => 'Desscription de la pâtisserie 1',
            'en_description' => 'Pastry\'s 1 description',
            'fr_featured_description' => null,
            'en_featured_description' => null,
            'price' => 30,
            'discount' => 0,
            'ranking' => 10,
            'is_featured' => false,
            'category_id' => 1,
        ]);

        DB::table('products')->insert([
            'slug' => 'pastry_2',
            'image' => 'product_2',
            'fr_name' => 'Pâtisserie 2',
            'en_name' => 'Pastry 2',
            'fr_featured_title' => null,
            'en_featured_title' => null,
            'fr_description' => 'Desscription de la pâtisserie 2',
            'en_description' => 'Pastry\'s 2 description',
            'fr_featured_description' => null,
            'en_featured_description' => null,
            'price' => 10,
            'discount' => 30,
            'ranking' => 10,
            'is_featured' => false,
            'category_id' => 1,
        ]);

        DB::table('products')->insert([
            'slug' => 'pastry_3',
            'image' => 'product_3',
            'fr_name' => 'Pâtisserie 3',
            'en_name' => 'Pastry 3',
            'fr_featured_title' => null,
            'en_featured_title' => null,
            'fr_description' => 'Desscription de la pâtisserie 3',
            'en_description' => 'Pastry\'s 3 description',
            'fr_featured_description' => null,
            'en_featured_description' => null,
            'price' => 20,
            'discount' => 0,
            'ranking' => 6,
            'is_featured' => true,
            'category_id' => 1,
        ]);

        DB::table('products')->insert([
            'slug' => 'pastry_4',
            'image' => 'product_4',
            'fr_name' => 'Pâtisserie 4',
            'en_name' => 'Pastry 4',
            'fr_featured_title' => null,
            'en_featured_title' => null,
            'fr_description' => 'Desscription de la pâtisserie 4',
            'en_description' => 'Pastry\'s 4 description',
            'fr_featured_description' => null,
            'en_featured_description' => null,
            'price' => 35,
            'discount' => 10,
            'ranking' => 10,
            'is_featured' => false,
            'category_id' => 1,
        ]);

        DB::table('products')->insert([
            'slug' => 'pastry_5',
            'image' => 'product_5',
            'fr_name' => 'Pâtisserie 5',
            'en_name' => 'Pastry 5',
            'fr_featured_title' => null,
            'en_featured_title' => null,
            'fr_description' => 'Desscription de la pâtisserie 5',
            'en_description' => 'Pastry\'s 5 description',
            'fr_featured_description' => null,
            'en_featured_description' => null,
            'price' => 25,
            'discount' => 0,
            'ranking' => 10,
            'is_featured' => false,
            'category_id' => 1,
        ]);

        DB::table('products')->insert([
            'slug' => 'pastry_6',
            'image' => 'product_6',
            'fr_name' => 'Pâtisserie 6',
            'en_name' => 'Pastry 6',
            'fr_featured_title' => null,
            'en_featured_title' => null,
            'fr_description' => 'Desscription de la pâtisserie 6',
            'en_description' => 'Pastry\'s 6 description',
            'fr_featured_description' => null,
            'en_featured_description' => null,
            'price' => 15,
            'discount' => 0,
            'ranking' => 5,
            'is_featured' => true,
            'category_id' => 1,
        ]);

    }
}
