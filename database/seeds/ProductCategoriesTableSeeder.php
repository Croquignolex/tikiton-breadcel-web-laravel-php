<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_categories')->insert([
            'slug' => 'category_1',
            'fr_name' => 'Catégorie 1',
            'en_name' => 'Category 1',
            'fr_description' => 'Description de la catégorie 1',
            'en_description' => 'Category\'s 1 description'
        ]);

        DB::table('product_categories')->insert([
            'slug' => 'category_2',
            'fr_name' => 'Catégorie 2',
            'en_name' => 'Category 2',
            'fr_description' => 'Description de la catégorie 2',
            'en_description' => 'Category\'s 2 description'
        ]);
    }
}
