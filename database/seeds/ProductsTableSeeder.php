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
            'fr_description' => 'Desscription de la pâtisserie 1',
            'en_description' => 'Pastry\'s 1 description',
            'price' => 30,
            'discount' => 0,
            'ranking' => 9,
            'is_featured' => false,
            'is_new' => true,
            'is_most_sold' => false,
            'stock' => 10,
            'category_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'slug' => 'pastry_2',
            'image' => 'product_2',
            'fr_name' => 'Pâtisserie 2',
            'en_name' => 'Pastry 2',
            'fr_description' => 'Desscription de la pâtisserie 2',
            'en_description' => 'Pastry\'s 2 description',
            'price' => 10,
            'discount' => 30,
            'ranking' => 8,
            'is_featured' => false,
            'is_new' => true,
            'is_most_sold' => false,
            'stock' => 10,
            'category_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'slug' => 'pastry_3',
            'image' => 'product_3',
            'fr_name' => 'Pâtisserie 3',
            'en_name' => 'Pastry 3',
            'fr_description' => 'Desscription de la pâtisserie 3',
            'en_description' => 'Pastry\'s 3 description',
            'price' => 20,
            'discount' => 0,
            'ranking' => 6,
            'is_featured' => false,
            'is_new' => true,
            'is_most_sold' => false,
            'stock' => 10,
            'category_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'slug' => 'pastry_4',
            'image' => 'product_4',
            'fr_name' => 'Pâtisserie 4',
            'en_name' => 'Pastry 4',
            'fr_description' => 'Desscription de la pâtisserie 4',
            'en_description' => 'Pastry\'s 4 description',
            'price' => 35,
            'discount' => 10,
            'ranking' => 7,
            'is_featured' => false,
            'is_new' => true,
            'is_most_sold' => true,
            'stock' => 10,
            'category_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'slug' => 'pastry_5',
            'image' => 'product_5',
            'fr_name' => 'Pâtisserie 5',
            'en_name' => 'Pastry 5',
            'fr_description' => 'Desscription de la pâtisserie 5',
            'en_description' => 'Pastry\'s 5 description',
            'price' => 25,
            'discount' => 0,
            'ranking' => 6,
            'is_featured' => false,
            'is_new' => true,
            'is_most_sold' => true,
            'stock' => 10,
            'category_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'slug' => 'pastry_6',
            'image' => 'product_6',
            'fr_name' => 'Pâtisserie 6',
            'en_name' => 'Pastry 6',
            'fr_description' => 'Desscription de la pâtisserie 6',
            'en_description' => 'Pastry\'s 6 description',
            'price' => 15,
            'discount' => 0,
            'ranking' => 5,
            'is_featured' => true,
            'is_new' => false,
            'is_most_sold' => true,
            'stock' => 10,
            'category_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'slug' => 'rounds',
            'image' => 'product_7',
            'fr_name' => 'Ronds',
            'en_name' => 'Rounds',
            'fr_description' => 'Ronds aux dattes, raisin et graines de pavot',
            'en_description' => 'Round at dates, grapes and poppy seeds',
            'price' => 2,
            'discount' => 0,
            'ranking' => 8,
            'is_featured' => true,
            'is_new' => false,
            'is_most_sold' => true,
            'stock' => 10,
            'category_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'slug' => 'cake',
            'image' => 'product_8',
            'fr_name' => 'Cateaux',
            'en_name' => 'Cake',
            'fr_description' => 'Gateaux aux dattes, raisin et graines de lin',
            'en_description' => 'Cake at dates, grapes and lin seeds',
            'price' => 2.5,
            'discount' => 0,
            'ranking' => 8,
            'is_featured' => false,
            'is_new' => false,
            'is_most_sold' => true,
            'stock' => 10,
            'category_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'slug' => 'lin_donut',
            'image' => 'product_9',
            'fr_name' => 'Beignet au lin',
            'en_name' => 'Lin donut',
            'fr_description' => 'Beignet aux graines de lin',
            'en_description' => 'Donut at lin seeds',
            'price' => 3.5,
            'discount' => 0,
            'ranking' => 7,
            'is_featured' => false,
            'is_new' => false,
            'is_most_sold' => true,
            'stock' => 10,
            'category_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'slug' => 'chocolate_donut',
            'image' => 'product_10',
            'fr_name' => 'Beignet au chocolat',
            'en_name' => 'Chocolate donut',
            'fr_description' => 'Beignet aux pépites de chocolat',
            'en_description' => 'Donut with chocolate seeds',
            'price' => 4.5,
            'discount' => 0,
            'ranking' => 9,
            'is_featured' => true,
            'is_new' => false,
            'is_most_sold' => true,
            'stock' => 10,
            'category_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'slug' => 'plain_donut',
            'image' => 'product_11',
            'fr_name' => 'Beignet nature',
            'en_name' => 'Plain donut',
            'fr_description' => 'Beignet nature avec juste du sucre',
            'en_description' => 'Plain donut with only sugar',
            'price' => 3,
            'discount' => 0,
            'ranking' => 9,
            'is_featured' => true,
            'is_new' => false,
            'is_most_sold' => true,
            'stock' => 10,
            'category_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'slug' => 'chocolate_cake',
            'image' => 'product_12',
            'fr_name' => 'Gâteaux au chocolat',
            'en_name' => 'Chocolate cake',
            'fr_description' => 'Gâteaux au chocolat',
            'en_description' => 'Cake with chocolate',
            'price' => 2,
            'discount' => 0,
            'ranking' => 9,
            'is_featured' => true,
            'is_new' => true,
            'is_most_sold' => false,
            'stock' => 10,
            'category_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'slug' => 'chocolate_bread',
            'image' => 'product_13',
            'fr_name' => 'Pain au chocolat',
            'en_name' => 'Chocolate bread',
            'fr_description' => 'Pain au chocolat',
            'en_description' => 'Bread with chocolate',
            'price' => 2.5,
            'discount' => 0,
            'ranking' => 9,
            'is_featured' => true,
            'is_new' => false,
            'is_most_sold' => true,
            'stock' => 10,
            'category_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'slug' => 'sweet_donut',
            'image' => 'product_14',
            'fr_name' => 'Beignet sucré',
            'en_name' => 'Sweet donut',
            'fr_description' => 'Beignet avec le sucre',
            'en_description' => 'Donut with sugar',
            'price' => 3,
            'discount' => 0,
            'ranking' => 7,
            'is_featured' => true,
            'is_new' => true,
            'is_most_sold' => true,
            'stock' => 10,
            'category_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'slug' => 'sweet_chocolate_donut',
            'image' => 'product_15',
            'fr_name' => 'Beignet sucré au chocolat',
            'en_name' => 'Sweet chocolate donut',
            'fr_description' => 'Beignet avec le sucre et le chocolat',
            'en_description' => 'Donut with sugar and chocolate',
            'price' => 5.5,
            'discount' => 0,
            'ranking' => 8,
            'is_featured' => true,
            'is_new' => true,
            'is_most_sold' => true,
            'stock' => 10,
            'category_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'slug' => 'plain_bread',
            'image' => 'product_16',
            'fr_name' => 'Pain simple',
            'en_name' => 'Plain bread',
            'fr_description' => 'Pain simple au lait',
            'en_description' => 'Plain bread with milk',
            'price' => 4,
            'discount' => 0,
            'ranking' => 9,
            'is_new' => true,
            'is_most_sold' => true,
            'stock' => 10,
            'category_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
