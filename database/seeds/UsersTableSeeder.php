<?php

use Illuminate\Database\Seeder;
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
            'slug' => 'alex_ngombol',
            'image' => NULL,
            'name' => 'Alex NGOMBOL',
            'email' => 'alex@breadcel.com',
            'password' => Hash::make('breadcel'),
            'is_confirmed' => true,
        ]);
    }
}
