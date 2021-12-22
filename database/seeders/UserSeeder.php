<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => '1',
            'name' => 'Ishani',
            'mobile' => '8569874569',
            'email' => 'ishani@gmail.com',
            'image' => 'profile.jpg',
            'password' => Hash::make('ishani'),
            'status' => '1',
            'slug' => 'Ishani',
        ]);
        DB::table('users')->insert([
            'id' => '2',
            'name' => 'Hinal',
            'mobile' => '8564874569',
            'email' => 'hinal@gmail.com',
            'image' => 'profile2.jpeg',
            'password' => Hash::make('hinal'),
            'status' => '1',
            'slug' => 'Hinal',
        ]);
    }
}
