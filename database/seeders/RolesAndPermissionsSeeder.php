<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
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
            'manage posts',
            'manage questions',
            'manage answers',
            'manage comments',
            'manage groups',
            'manage categories',
            'manage own posts',
            'manage own questions',
            'manage own answers',
            'manage own comments'
        ];
       
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Assign permissions to roles
        $adminRole->givePermissionTo(Permission::all());
        $editorRole->givePermissionTo([ 
           'manage own posts',
            'manage own questions',
            'manage own answers',
            'manage own comments']);
        $userRole->givePermissionTo([
            'manage own questions',
            'manage own answers',
            'manage own comments'
        ]);
        $user = User::find(1);
        $user->assignRole('admin');
    }
}
