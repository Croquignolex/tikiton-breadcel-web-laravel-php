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
            'slug' => 'customer_at_breadcel_ca',
            'first_name' => 'Mr',
            'last_name' => 'Customer',
            'email' => 'customer@breadcel.ca',
            'password' => Hash::make('breadcel'),
            'token' => str_random(64),
            'is_confirmed' => true
        ]);

        DB::table('users')->insert([
            'slug' => 'alex_at_breadcel_ca',
            'first_name' => 'Alex',
            'last_name' => 'NGOMBOL',
            'email' => 'alex@breadcel.ca',
            'password' => Hash::make('breadcel'),
            'token' => str_random(64),
            'is_super_admin' => true,
            'is_confirmed' => true,
            'is_admin' => true,
        ]);

        DB::table('users')->insert([
            'slug' => 'celestin_at_breadcel_ca',
            'first_name' => 'Celestin',
            'last_name' => 'WOKGOUE',
            'email' => 'celestin@breadcel.ca',
            'password' => Hash::make('breadcel'),
            'token' => str_random(64),
            'is_admin' => true,
            'is_confirmed' => true
        ]);
    }
}
