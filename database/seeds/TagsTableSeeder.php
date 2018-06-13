<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert([
            'slug' => 'tag_1',
            'fr_name' => 'Etiquette 1',
            'en_name' => 'Tag 1',
            'fr_description' => 'Description de l\'étiquette 1',
            'en_description' => 'Tag\'s 1 description'
        ]);

        DB::table('tags')->insert([
            'slug' => 'tag_2',
            'fr_name' => 'Etiquette 2',
            'en_name' => 'Tag 2',
            'fr_description' => 'Description de l\'étiquette 2',
            'en_description' => 'Tag\'s 2 description'
        ]);

        DB::table('tags')->insert([
            'slug' => 'tag_3',
            'fr_name' => 'Etiquette 3',
            'en_name' => 'Tag 3',
            'fr_description' => 'Description de l\'étiquette 3',
            'en_description' => 'Tag\'s 3 description'
        ]);

        DB::table('tags')->insert([
            'slug' => 'tag_4',
            'fr_name' => 'Etiquette 4',
            'en_name' => 'Tag 4',
            'fr_description' => 'Description de l\'étiquette 4',
            'en_description' => 'Tag\'s 4 description'
        ]);

        DB::table('tags')->insert([
            'slug' => 'tag_5',
            'fr_name' => 'Etiquette 5',
            'en_name' => 'Tag 5',
            'fr_description' => 'Description de l\'étiquette 5',
            'en_description' => 'Tag\'s 5 description'
        ]);
    }
}
