<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            // User
            'view users',
            'create users',
            'edit users',
            'delete users',
            'assign roles',

            // Properties
            'view properties',
            'create properties',
            'edit properties',
            'delete properties',
            'publish properties',
            'feature properties',

            // Agents
            'view agents',
            'approve agents',
            'ban agents',

            // Media
            'upload images',
            'delete images',

            // Inquiries
            'view inquiries',
            'respond to inquiries',
            'delete inquiries',

            // Features
            'view features',
            'create features',
            'edit features',
            'delete features',

            // Analytics
            'view analytics',
            'view search logs',

            // Settings
            'update settings',
            'manage SEO',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $agent = Role::firstOrCreate(['name' => 'agent']);
        $user  = Role::firstOrCreate(['name' => 'user']);

        // Assign all to admin
        $admin->syncPermissions(Permission::all());

        // Agent gets limited
        $agent->syncPermissions([
            'view properties',
            'create properties',
            'edit properties',
            'delete properties',
            'upload images',
            'delete images',
            'view inquiries',
            'respond to inquiries',
            'view analytics',
        ]);

        // Users = browse only
        $user->syncPermissions([
            'view properties',
        ]);
        if (User::count() == 1)
            $adminUser = User::first();
        $adminUser->assignRole('admin');
        $adminUser->syncPermissions(Permission::all());
    }
}
