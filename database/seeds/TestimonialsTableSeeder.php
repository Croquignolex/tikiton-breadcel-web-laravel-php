<?php

use Illuminate\Database\Seeder;

class TestimonialsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('testimonials')->insert([
            'slug' => 'alex_ngombol',
            'image' => 'testimonial_1',
            'name' => 'Alex NGOMBOL',
            'fr_description' => 'Je me m\'en lasse pas, je n\'est rien mager d\'aussi bon',
            'en_description' => 'I have never eat something so delicious, i can\'t refuse it',
        ]);

        DB::table('testimonials')->insert([
            'slug' => 'trina_wokgoue',
            'image' => 'testimonial_2',
            'name' => 'Trina WOKGOUE',
            'fr_description' => 'Je me m\'en lasse pas, je n\'est rien mager d\'aussi bon',
            'en_description' => 'I have never eat something so delicious, i can\'t refuse it',
        ]);
    }
}
