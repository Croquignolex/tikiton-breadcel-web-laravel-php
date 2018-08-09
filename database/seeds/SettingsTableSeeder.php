<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'label' => 'Par défaut',
            'is_activated' => true,
            'slogan' => 'Cel & Cel Bread\'Cel',
            'address_1' => '18A Rue Dollard',
            'address_2' => 'Ville-Marie(Qc), J9V 1L2',
            'phone_1' => '(819) 444 6691',
            'phone_2' => '(819) 444 8613',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('settings')->insert([
            'label' => 'Sans TVA',
            'tva' => 0,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
