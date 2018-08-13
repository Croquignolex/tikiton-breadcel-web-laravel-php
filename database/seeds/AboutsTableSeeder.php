<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AboutsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('abouts')->insert([
            'image' => 'about_bg',
            'fr_about_section_1_normal_zone' => 'Les immigransts nouvellement installés au Témiscamingue participent de ' .
                'plus en plus au developpement économique du territoire. C\'est le cas du couple Wokgoue, ' .
                'qui offre un service de boulangerie artisanale à Ville-Marie',
            'fr_about_section_1_important_zone' => '<< De voir que, naturellement, les gens démarrent des choses ' .
                'et des nouveaux projets, c\'est encourageant. Ca permet de voir que le territoire ' .
                'se développe et qu\'on peut être un peu plus attractif. >> Catherine Drolet',
            'fr_about_section_2_normal_zone' => 'Farine, beurre et levure...des ingrédients pour boulanger le pain, il y en a un peu ' .
                'partout dans la petite cuisine des Wokgoue',
            'fr_about_section_2_important_zone' => '<< Je crois que dans la vie, on si on vit de sa passion,  c\'est très bien ' .
                 'C\'est beau de faire ce qu\'on aime et c\'est encore mieux de vivre de ce qu\'on aime. >> ' .
                 'Célestin Wokgoue',
            'en_about_section_1_normal_zone' => 'Les immigransts nouvellement installés au Témiscamingue participent de ' .
                'plus en plus au developpement économique du territoire. C\'est le cas du couple Wokgoue, ' .
                'qui offre un service de boulangerie artisanale à Ville-Marie',
            'en_about_section_1_important_zone' => '<< De voir que, naturellement, les gens démarrent des choses ' .
                'et des nouveaux projets, c\'est encourageant. Ca permet de voir que le territoire ' .
                'se développe et qu\'on peut être un peu plus attractif. >> Catherine Drolet',
            'en_about_section_2_normal_zone' => 'Farine, beurre et levure...des ingrédients pour boulanger le pain, il y en a un peu ' .
                'partout dans la petite cuisine des Wokgoue',
            'en_about_section_2_important_zone' => '<< Je crois que dans la vie, on si on vit de sa passion,  c\'est très bien ' .
                'C\'est beau de faire ce qu\'on aime et c\'est encore mieux de vivre de ce qu\'on aime. >> ' .
                'Célestin Wokgoue',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
