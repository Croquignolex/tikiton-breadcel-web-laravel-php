<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HomesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('homes')->insert([
            'banner_1' => 'banner1',
            'banner_2' => 'banner2',
            'banner_3' => 'banner3',
            'offer_1' => 'offer_top1',
            'offer_2' => 'offer_top2',
            'offer_3' => 'offer_bottom1',
            'offer_4' => 'offer_bottom2',
            'magic' => 'magic',
            'fr_banner_1_text_1' => 'Expressif',
            'fr_banner_1_text_2' => 'Exprimez vous',
            'fr_banner_2_text_1' => 'Délicieux',
            'fr_banner_2_text_2' => 'Faites vous plaisir',
            'fr_banner_3_text_1' => 'Extra',
            'fr_banner_3_text_2' => 'Totalement bon',
            'fr_offer_1_text_1' => 'Croissants extraordinaires',
            'fr_offer_1_text_2' => 'Ils sont très mignons et très bon',
            'fr_offer_2_text_1' => 'Pains impressionant',
            'fr_offer_2_text_2' => 'Une autre facon de se nourir',
            'fr_offer_3_text_1' => 'Bread\'sel magnifiques',
            'fr_offer_3_text_2' => 'Toute notre passion dans une seule pâtisserie',
            'fr_offer_4_text_1' => 'Delicieux',
            'fr_offer_4_text_2' => 'Vous devez le goûter pour comprendre',
            'fr_magic_header' => 'Tous est dans la passion',
            'fr_magic_title' => 'Pour plus de perfection',
            'fr_magic_description' => 'Pour le meilleur pour vous, nous exprimons le meilleur de nous même, le meilleur de notre passsion',
            'en_banner_1_text_1' => 'Exclusive',
            'en_banner_1_text_2' => 'Express yourself',
            'en_banner_2_text_1' => 'Delicious',
            'en_banner_2_text_2' => 'Take pleasure',
            'en_banner_3_text_1' => 'Awesome',
            'en_banner_3_text_2' => 'Fully nice',
            'en_offer_1_text_1' => 'Extraordinary croissants',
            'en_offer_1_text_2' => 'There are very cute and nice',
            'en_offer_2_text_1' => 'Awesome breads',
            'en_offer_2_text_2' => 'This is a different way to eat',
            'en_offer_3_text_1' => 'Nice Bread\'sel',
            'en_offer_3_text_2' => 'All our passion in only one pastry',
            'en_offer_4_text_1' => 'Delicious',
            'en_offer_4_text_2' => 'You have to taste it to understand',
            'en_magic_header' => 'All is in passion',
            'en_magic_title' => 'For more perfection',
            'en_magic_description' => 'For the best for you, we express the best of us, the best of our passion',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
