<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        $adminRole = Role::create(['name' => 'admin']);
        $editorRole = Role::create(['name' => 'editor']);
        $userRole = Role::create(['name' => 'user']);

        // Create permissions
        $permissions = [
            'manage users',

            'create group',
            'edit group',
            'delete group',
            'publish group',
            'view group',

            'create category',
            'edit category',
            'delete category',
            'publish category',
            'view category',

            'create post',
            'edit post',
            'delete post',
            'publish post',
            'view post',

            'create question',
            'edit question',
            'delete question',
            'publish question',
            'view question',

            'create comment',
            'edit comment',
            'replay comment',

            'create vote',
            'create answer',
            'edit answer',
            'replay answer',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Assign permissions to roles
        $adminRole->givePermissionTo(Permission::all());
        $editorRole->givePermissionTo(['edit articles', 'view articles']);
        $userRole->givePermissionTo(['view articles']);
    }
}
