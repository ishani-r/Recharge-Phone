<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = [
            // --------------------------- Admin ---------------------------
            [
                'module_name' => 'Admin',
                'name' => 'create-admin', 
                'guard_name' => 'admin'
            ],
            [
                'module_name' => 'Admin',
                'name' => 'view-admin-table', 
                'guard_name' => 'admin'
            ],
            [
                'module_name' => 'Admin',
                'name' => 'update-admin', 
                'guard_name' => 'admin'
            ],
            [
                'module_name' => 'Admin',
                'name' => 'delete-admin', 
                'guard_name' => 'admin'
            ],
            // --------------------------- User ---------------------------
            [
                'module_name' => 'User',
                'name' => 'view-user-table', 
                'guard_name' => 'admin'
            ],
            [
                'module_name' => 'User',
                'name' => 'view-user-data', 
                'guard_name' => 'admin'
            ],
            [
                'module_name' => 'User',
                'name' => 'update-user-data', 
                'guard_name' => 'admin'
            ],
            [
                'module_name' => 'User',
                'name' => 'delete-user-data',
                'guard_name' => 'admin'
            ],
            // --------------------------- UserDetail ---------------------------
            [
                'module_name' => 'UserDetail',
                'name' => 'view-userdetail-table',
                'guard_name' => 'admin'
            ],
            [
                'module_name' => 'UserDetail',
                'name' => 'view-userdetail-data',
                'guard_name' => 'admin'
            ],
            [
                'module_name' => 'UserDetail',
                'name' => 'update-userdetail-data',
                'guard_name' => 'admin'
            ],
            [
                'module_name' => 'UserDetail',
                'name' => 'delete-userdetail-data',
                'guard_name' => 'admin'
            ],
           // --------------------------- Premium ---------------------------
           [
               'module_name' => 'Premium',
               'name' => 'create-package',
                'guard_name' => 'admin'
            ],
            [
                'module_name' => 'Premium',
                'name' => 'view-package',
                'guard_name' => 'admin'
            ],
            [
                'module_name' => 'Premium',
                'name' => 'update-package',
                'guard_name' => 'admin'
            ],
            [
                'module_name' => 'Premium',
                'name' => 'delete-package',
                'guard_name' => 'admin'
            ],
            // --------------------------- Setting ---------------------------
            [
                'module_name' => 'Setting',
                'name' => 'create-terms',
                'guard_name' => 'admin'
            ],
            [
                'module_name' => 'Setting',
                'name' => 'view-terms',
                'guard_name' => 'admin'
            ],
            [
                'module_name' => 'Setting',
                'name' => 'update-terms',
                'guard_name' => 'admin'
            ],
            [
                'module_name' => 'Setting',
                'name' => 'delete-terms',
                'guard_name' => 'admin'
            ],
            // --------------------------- Notification ---------------------------
            [
                'module_name' => 'Notification',
                'name' => 'create-notification',
                'guard_name' => 'admin'
            ],
            [
                'module_name' => 'Notification',
                'name' => 'view-notification',
                'guard_name' => 'admin'
            ],
            [
                'module_name' => 'Notification',
                'name' => 'update-notification',
                'guard_name' => 'admin'
            ],
            [
                'module_name' => 'Notification',
                'name' => 'delete-notification',
                'guard_name' => 'admin'
            ],
            // --------------------------- Language ---------------------------
            [
                'module_name' => 'Language',
                'name' => 'view-language',
                'guard_name' => 'admin'
            ],
            [
                'module_name' => 'Language',
                'name' => 'create-language',
                'guard_name' => 'admin'
            ],
            [
                'module_name' => 'Language',
                'name' => 'update-language',
                'guard_name' => 'admin'
            ],
            [
                'module_name' => 'Language',
                'name' => 'delete-language',
                'guard_name' => 'admin'
            ],
            // --------------------------- Help ---------------------------
            [
                'module_name' => 'Help',
                'name' => 'create-question-answer',
                'guard_name' => 'admin'
            ],
            [
                'module_name' => 'Help',
                'name' => 'view-question-answer',
                'guard_name' => 'admin'
            ],
            [
                'module_name' => 'Help',
                'name' => 'update-question-answer',
                'guard_name' => 'admin'
            ],
            [
                'module_name' => 'Help',
                'name' => 'delete-question-answer',
                'guard_name' => 'admin'
            ],
            // --------------------------- Contact ---------------------------
            [
                'module_name' => 'Contact',
                'name' => 'view-contacts-replay',
                'guard_name' => 'admin'
            ],
            [
                'module_name' => 'Contact',
                'name' => 'view-contacts-replay-table',
                'guard_name' => 'admin'
            ],
            [
                'module_name' => 'Contact',
                'name' => 'update-contacts-replay-table',
                'guard_name' => 'admin'
            ],
            [
                'module_name' => 'Contact',
                'name' => 'delete-contacts-replay-table',
                'guard_name' => 'admin'
            ],
            // --------------------------- Permission ---------------------------
            [
                'module_name' => 'Permission',
                'name' => 'view-access',
                'guard_name' => 'admin'
            ],
            [
                'module_name' => 'Permission',
                'name' => 'view-permission-table',
                'guard_name' => 'admin'
            ],
            [
                'module_name' => 'Permission',
                'name' => 'update-permission',
                'guard_name' => 'admin'
            ],
            [
                'module_name' => 'Permission',
                'name' => 'delete-permission',
                'guard_name' => 'admin'
            ],
            // --------------------------- Role ---------------------------
            [
                'module_name' => 'Role',
                'name' => 'create-role-table',
                'guard_name' => 'admin'
            ],
            [
                'module_name' => 'Role',
                'name' => 'view-role-table',
                'guard_name' => 'admin'
            ],
            [
                'module_name' => 'Role',
                'name' => 'update-role',
                'guard_name' => 'admin'
            ],
            [
                'module_name' => 'Role',
                'name' => 'delete-role',
                'guard_name' => 'admin'
            ],
        ];
        Permission::insert($permission);
    }
}
