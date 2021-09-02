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

        /** @var User $superAdmin */
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

        // You can assign multiple roles at user
        $superAdmin->assignRole('super-admin', 'admin', 'user');
        $admin->assignRole('admin', 'user');
        $user->assignRole('user');

    }
}


