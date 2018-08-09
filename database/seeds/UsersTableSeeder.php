<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'Alex',
            'last_name' => 'NGOMBOL',
            'email' => 'alex.ngombol@breadcel.ca',
            'password' => Hash::make('k@lonayA10'),
            'token' => str_random(64),
            'is_super_admin' => true,
            'is_confirmed' => true,
            'is_admin' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'first_name' => 'Célestin',
            'last_name' => 'WOKGOUE',
            'email' => 'celestin.wokgoue@breadcel.ca',
            'password' => Hash::make('Bre@dcel2018'),
            'token' => str_random(64),
            'is_admin' => true,
            'is_confirmed' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'first_name' => 'Céline',
            'last_name' => 'WOKGOUE',
            'email' => 'celine.wokgoue@breadcel.ca',
            'password' => Hash::make('Bre@dcel2018'),
            'token' => str_random(64),
            'is_admin' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'first_name' => 'Trina',
            'last_name' => 'WOKGOUE',
            'email' => 'trina.wokgoue@breadcel.ca',
            'password' => Hash::make('Bre@dcel2018'),
            'token' => str_random(64),
            'is_admin' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
