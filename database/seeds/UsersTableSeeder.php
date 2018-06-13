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
            'slug' => 'mr_customer_1',
            'image' => NULL,
            'name' => 'Mr Customer 1',
            'email' => 'customer1@breadcel.com',
            'password' => Hash::make('breadcel'),
            'token' => str_random(64),
            'is_confirmed' => true,
        ]);

        DB::table('users')->insert([
            'slug' => 'mr_customer_2',
            'image' => NULL,
            'name' => 'Mr Customer 2',
            'email' => 'customer2@breadcel.com',
            'password' => Hash::make('breadcel'),
            'token' => str_random(64),
            'is_confirmed' => true,
        ]);

        DB::table('users')->insert([
            'slug' => 'alex_ngombol',
            'image' => NULL,
            'name' => 'Alex NGOMBOL',
            'email' => 'alex@breadcel.com',
            'password' => Hash::make('breadcel'),
            'token' => str_random(64),
            'is_confirmed' => true,
            'is_super_admin' => true,
        ]);

        DB::table('users')->insert([
            'slug' => 'celestin_wokgoue',
            'image' => NULL,
            'name' => 'Celestin WOKGOUE',
            'email' => 'celestion@breadcel.com',
            'password' => Hash::make('breadcel'),
            'token' => str_random(64),
            'is_confirmed' => true,
            'is_admin' => true,
        ]);
    }
}
