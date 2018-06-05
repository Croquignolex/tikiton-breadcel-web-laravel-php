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
            'slug' => 'celestin_wokgoue',
            'image' => 'team_1',
            'name' => 'celestin wokgoue',
            'description' => 'General manager description',
            'function' => 'General manager'
        ]);

        DB::table('teams')->insert([
            'slug' => 'alex_ngombol',
            'image' => 'team_2',
            'name' => ' Alex Ngombol',
            'description' => 'Software ingenier description',
            'function' => 'Software ingenier'
        ]);

        DB::table('teams')->insert([
            'slug' => 'celine_wokgoue',
            'image' => 'team_3',
            'name' => 'celine wokgoue',
            'description' => 'Co-manager description',
            'function' => 'Co-manager'
        ]);

        DB::table('teams')->insert([
            'slug' => 'trina_wokgoue',
            'image' => 'team_4',
            'name' => 'trina wokgoue',
            'description' => 'Chief Designer description',
            'function' => 'Chief Designer'
        ]);
    }
}
