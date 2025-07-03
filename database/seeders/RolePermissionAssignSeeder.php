<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionAssignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::find(1);
        $allPermission = Permission::get();
        $role->syncPermissions($allPermission->pluck('id'));
        $user = User::where('email','sadman@gmail.com')->first();
        $user->assignRole('admin');
        
        $moderator = Role::find(2);
        $productPermissions = $allPermission->where('group_name', 'product');
        $moderator->syncPermissions($productPermissions->pluck('id'));
        $user = User::where('email', 'shourab.cit.bd@gmail.com')->first();
        $user->assignRole('moderator');
    }
}
