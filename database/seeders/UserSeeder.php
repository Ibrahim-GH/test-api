<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //generation user data with seeder
//        User::factory(5)->create();

        $superAdmin = User::create([
            'name' => 'super-admin',
            'address' => 'damascus1',
            'phone_number' => '0959105035',
            'email' => 'super-admin@admin.com',
            'password' => bcrypt('super-admin123'),
        ]);

        $admin = User::create([
            'name' => 'admin',
            'address' => 'damascus2',
            'phone_number' => '0959105036',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin12345'),
        ]);

        $user = User::create([
            'name' => 'user',
            'address' => 'damascus3',
            'phone_number' => '0959105037',
            'email' => 'user@user.com',
            'password' => bcrypt('user123'),
        ]);

        // You can also assign multiple roles at once
        $superAdmin->assignRole('super-admin', 'admin', 'user');
        $admin->assignRole('admin', 'user');
        $user->assignRole('user');

        $permissions = [
            'edit-store',
            'create-category', 'edit-category', 'show-category-products', 'show-category',
            'show-all-category', 'delete-category', 'restore-category',
            'create-attribute', 'edit-attribute', 'show-attribute', 'show-all-attributes',
            'delete-attribute', 'restore-attribute',
            'create-parameter', 'edit-parameter', 'show-all-parameters', 'show-parameter',
            'delete-parameter', 'restore-parameter',
            'create-product', 'edit-product', 'show-all-products', 'show-product',
            'delete-product', 'restore-product',
            'create-order', 'show-all-orders', 'show-order',
            'delete-order', 'restore-order',
        ];

        // You can also assign multiple permission at once
        $superAdmin->givePermissionTo('create-store', 'delete-store',
            'restore-store', 'delete-user', 'restore-user', $permissions);

        $admin->givePermissionTo($permissions);

        $user->givePermissionTo(
            [
                'create-order', 'show-order', 'show-all-orders',
            ]);
    }
}


