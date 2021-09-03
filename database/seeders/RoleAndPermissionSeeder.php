<?php

namespace Database\Seeders;

use App\Enums\PermissionName;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        $permissions = PermissionName::getValues();
        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission
            ]);
        }

        $adminPermissions = [
            'edit-store',
            'create-category', 'edit-category', 'show-category-products', 'show-category',
            'show-all-category', 'delete-category', 'restore-category',
            'create-attribute', 'edit-attribute', 'show-attribute', 'show-all-attributes',
            'delete-attribute', 'restore-attribute',
            'create-parameter', 'edit-parameter', 'show-all-parameters', 'show-parameter',
            'delete-parameter', 'restore-parameter',
            'create-product', 'edit-product', 'show-all-products', 'show-product',
            'delete-product', 'restore-product',
            'create-order', 'show-all-orders', 'show-order','edit-order',
            'delete-order', 'restore-order',
        ];

        // create roles and assign created permissions
        // this can be done as separate statements
        $role1 = Role::create(['name' => 'super-admin']);
        $role1->givePermissionTo('create-store', 'edit-store','show-all-users',
            'delete-store', 'restore-store', 'delete-user', 'restore-user');
        $role1->givePermissionTo($adminPermissions);

        $role2 = Role::create(['name' => 'admin']);
        $role2->givePermissionTo($adminPermissions);

        $role3 = Role::create(['name' => 'user']);
        $role3->givePermissionTo(
            [
                'create-order', 'delete-order',
                'show-order', 'show-all-orders',
            ]);
    }
}
