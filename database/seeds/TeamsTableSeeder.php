<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teams')->insert([
            'image' => 'team_1',
            'name' => 'celestin wokgoue',
            'fr_description' => 'General manager description',
            'en_description' => 'General manager description',
            'fr_function' => 'General manager',
            'en_function' => 'General manager'
        ]);

        DB::table('teams')->insert([
            'image' => 'team_2',
            'name' => ' Alex Ngombol',
            'fr_description' => 'Software ingenier description',
            'en_description' => 'Software ingenier description',
            'fr_function' => 'Software ingenier',
            'en_function' => 'Software ingenier'
        ]);

        DB::table('teams')->insert([
            'image' => 'team_3',
            'name' => 'celine wokgoue',
            'fr_description' => 'Co-manager description',
            'en_description' => 'Co-manager description',
            'fr_function' => 'Co-manager',
            'en_function' => 'Co-manager'
        ]);

        DB::table('teams')->insert([
            'image' => 'team_4',
            'name' => 'trina wokgoue',
            'fr_description' => 'Chief Designer description',
            'en_description' => 'Chief Designer description',
            'fr_function' => 'Chief Designer',
            'en_function' => 'Chief Designer'
        ]);
    }
}
