<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use App\Models\Store;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //generation Store data with seeder
        //Store::factory(5)->create();


        for ($i = 1; $i <= 10; $i++) {
            Store::create([
                // 'user_id' => '1',
                'name' => 'store' . $i,
                'address' => 'damascus' . $i,
                'phone_number' => '0959105035',
            ]);
        }

    }
}
