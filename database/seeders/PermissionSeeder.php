<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $superadmin = Role::create(['name' => 'Super-Admin']);

        Permission::create(['name' => 'club-create']);
        Permission::create(['name' => 'club-delete']);
        Permission::create(['name' => 'club-edit']);
        Permission::create(['name' => 'club-userControl']);
        Permission::create(['name' => 'club-userAccept']);
        Permission::create(['name' => 'club-userRevoke']);
        Permission::create(['name' => 'club-show']);

        Permission::create(['name' => 'clubEvent-show']);
        Permission::create(['name' => 'clubEvent-create']);
        Permission::create(['name' => 'clubEvent-delete']);
        Permission::create(['name' => 'clubEvent-edit']);
        Permission::create(['name' => 'clubEvent-join']);
        Permission::create(['name' => 'clubEvent-left']);

        $role1 = Role::create(['name' => 'Editor']);
        $role1->givePermissionTo('club-create');
        $role1->givePermissionTo('club-edit');
        $role1->givePermissionTo('club-delete');
        $role1->givePermissionTo('club-show');
        $role1->givePermissionTo('club-userControl');
        $role1->givePermissionTo('club-userAccept');
        $role1->givePermissionTo('club-userRevoke');
        $role1->givePermissionTo('clubEvent-show');
        $role1->givePermissionTo('clubEvent-create');
        $role1->givePermissionTo('clubEvent-delete');
        $role1->givePermissionTo('clubEvent-edit');
        $role1->givePermissionTo('clubEvent-join');
        $role1->givePermissionTo('clubEvent-left');

        $role2 = Role::create(['name' => 'clubManager']);
        $role2->givePermissionTo('club-edit');
        $role2->givePermissionTo('club-userAccept');
        $role2->givePermissionTo('club-userRevoke');
        $role2->givePermissionTo('clubEvent-show');
        $role2->givePermissionTo('clubEvent-create');
        $role2->givePermissionTo('clubEvent-delete');
        $role2->givePermissionTo('clubEvent-edit');
        $role2->givePermissionTo('clubEvent-join');
        $role2->givePermissionTo('clubEvent-left');

        $member = Role::create(['name' => 'clubMember']);
        $member->givePermissionTo('clubEvent-join');
        $member->givePermissionTo('clubEvent-left');
    }
}
