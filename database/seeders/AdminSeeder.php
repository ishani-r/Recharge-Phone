<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin=Admin::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'image' => 'profile.jpg',
            'assign_role' => 'Administration'
        ]);
        $admin->assignRole('Administration');

        // $user=Admin::create([
        //     'name' => 'Ishani',
        //     'email' => 'ishani@gmail.com',
        //     'password' => Hash::make('123'),
        //     'image' => 'profile1.png',
        // ]);
        // $user->assignRole('User Manager');
        
        // $users=Admin::create([
        //     'name' => 'Hinal',
        //     'email' => 'hinal@gmail.com',
        //     'password' => Hash::make('123'),
        //     'image' => 'profile2.jpg',
        // ]);
        // $users->assignRole('Package Manager');
    }
}
