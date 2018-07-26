<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'image' => 'testimonial_1',
            'name' => 'Alex NGOMBOL',
            'fr_description' => 'Je me m\'en lasse pas, je n\'est rien mager d\'aussi bon. Pour un prix
                très bas, j\'ai eu un gateau digne des grandes boulangies, c\'était tout simplment magnifique. ',
            'en_description' => 'I have never eat something so delicious, i can\'t refuse it. For a very
                low price, i got a hight class cake, it was just handsome.',
        ]);

        DB::table('testimonials')->insert([
            'image' => 'testimonial_2',
            'name' => 'Trina WOKGOUE',
            'fr_description' => 'J\'ai trouvé le concept très innovateur pour cette localité. Ma premiere 
                commande fût un bapteme de delice, aujourdhui je suis une clientte régulière chez Breadcel',
            'en_description' => 'The concep was very new for this locality. My first command was à delicious baptisim,
                today, i am a regular customer of Breadcel',
        ]);
    }
}
