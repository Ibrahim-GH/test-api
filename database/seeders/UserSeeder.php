<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
            'remember_token' => Str::random(10),
        ]);

        $admin = User::create([
            'name' => 'admin',
            'address' => 'damascus2',
            'phone_number' => '0959105036',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin12345'),
            'remember_token' => Str::random(10),
        ]);

        $user = User::create([
            'name' => 'user',
            'address' => 'damascus3',
            'phone_number' => '0959105037',
            'email' => 'user@user.com',
            'password' => bcrypt('user123'),
            'remember_token' => Str::random(10),
        ]);

        // You can also assign multiple roles at once
        $superAdmin->assignRole('super-admin','admin','user');
        $admin->assignRole('admin','user');
        $user->assignRole('user');


        // You can also assign multiple permission at once
        $superAdmin->givePermissionTo(['create-store', 'show-all-stores',
            'delete-store', 'restore-store']);

        $admin->givePermissionTo(
            [
                'edit-store', 'show-store-products', 'show-store', 'delete-store', 'restore-store',
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


        $user->givePermissionTo(
            [
                'create-order', 'delete-order', 'show-order',
                'show-all-orders', 'restore-order',
            ]);

    }
}
