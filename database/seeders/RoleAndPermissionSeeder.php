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
//        Permission::create(['name' => 'create-store']);
//        Permission::create(['name' => 'edit-store']);
////        Permission::create(['name' => 'show-store']);
////        Permission::create(['name' => 'show-all-stores']);
////        Permission::create(['name' => 'show-store-products']);
//        Permission::create(['name' => 'delete-store']);
//        Permission::create(['name' => 'restore-store']);
//
//        Permission::create(['name' => 'create-category']);
//        Permission::create(['name' => 'edit-category']);
//        Permission::create(['name' => 'show-category']);
//        Permission::create(['name' => 'show-all-category']);
//        Permission::create(['name' => 'show-category-products']);
//        Permission::create(['name' => 'delete-category']);
//        Permission::create(['name' => 'restore-category']);
//
//        Permission::create(['name' => 'create-attribute']);
//        Permission::create(['name' => 'edit-attribute']);
//        Permission::create(['name' => 'show-attribute']);
//        Permission::create(['name' => 'show-all-attributes']);
//        Permission::create(['name' => 'delete-attribute']);
//        Permission::create(['name' => 'restore-attribute']);
//
//        Permission::create(['name' => 'create-parameter']);
//        Permission::create(['name' => 'edit-parameter']);
//        Permission::create(['name' => 'show-parameter']);
//        Permission::create(['name' => 'show-all-parameters']);
//        Permission::create(['name' => 'delete-parameter']);
//        Permission::create(['name' => 'restore-parameter']);
//
//        Permission::create(['name' => 'create-product']);
//        Permission::create(['name' => 'edit-product']);
//        Permission::create(['name' => 'show-product']);
//        Permission::create(['name' => 'show-all-products']);
//        Permission::create(['name' => 'delete-product']);
//        Permission::create(['name' => 'restore-product']);
//
//        Permission::create(['name' => Permissions::CREATE_ORDER]);
//        Permission::create(['name' => 'edit-order']);
//        Permission::create(['name' => 'show-order']);
//        Permission::create(['name' => 'show-all-orders']);
//        Permission::create(['name' => 'delete-order']);
//        Permission::create(['name' => 'restore-order']);

        $permissions =  PermissionName::getKeys();
        foreach ($permissions as $permission){
            Permission::create($permission);
        }

        // create roles and assign created permissions
        // this can be done as separate statements
        $role1 = Role::create(['name' => 'super-admin']);
        $role1->givePermissionTo(['create-store', 'edit-store',
            'delete-store', 'restore-store']);

        $role2 = Role::create(['name' => 'admin']);
        $role2->givePermissionTo(
            [
                'edit-store',
                'create-category', 'edit-category', 'show-category-products', 'show-category',
                'show-all-category', 'delete-category', 'restore-category',
                'create-attribute', 'edit-attribute', 'show-attribute', 'show-all-attributes',
                'delete-attribute', 'restore-attribute',
                'create-parameter', 'edit-parameter', 'show-all-parameters', 'show-parameter',
                'delete-parameter', 'restore-parameter',
                'create-product', 'edit-product', 'show-all-products', 'show-product',
                'delete-product', 'restore-product',
                'create-order', 'edit-order', 'show-all-orders', 'show-order',
                'delete-order', 'restore-order',
            ]);

        $role3 = Role::create(['name' => 'user']);
        $role3->givePermissionTo(
            [
                'create-order', 'delete-order', 'show-order',
                'show-all-orders', 'restore-order',
            ]);
    }
}
