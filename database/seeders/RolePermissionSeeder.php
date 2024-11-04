<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        $user = User::find(1);
        $user->assignRole('admin');

        // Create permissions
        // $editArticlesPermission = Permission::create(['name' => 'edit articles']);
        // $viewArticlesPermission = Permission::create(['name' => 'view articles']);

        // Assign permissions to roles
        // $adminRole->givePermissionTo([$editArticlesPermission, $viewArticlesPermission]);
        // $userRole->givePermissionTo($viewArticlesPermission);
    }
}
