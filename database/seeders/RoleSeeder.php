<?php

namespace Database\Seeders;

// use App\Models\Permission;
use Illuminate\Database\Seeder;
// use App\Models\Role;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin=Role::create([
            'name'=>'Administration',
            'guard_name'=> 'admin'
            ]);
        $admin->givePermissionTo(Permission::all());

        // $role=Role::create([
        //     'name'=>'User',
        //     'guard_name'=> 'admin'
        //     ]);
        // $role->givePermissionTo('view-user-table');
    }
}
