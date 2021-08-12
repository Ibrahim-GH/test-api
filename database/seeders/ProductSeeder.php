<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Store;
use Illuminate\Database\Seeder;
use App\Models\Product;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //generation product data with seeder
          //Product::factory(5)->create();


        for ($i = 0; $i <= 5; $i++) {
            Product::create([
                // 'user_id' => '1',
                'name' => 'product' . $i,
                'description' => 'product' . $i,
                'store_id' => $i,
                'category_id' => $i,
            ]);
        }

    }
}
