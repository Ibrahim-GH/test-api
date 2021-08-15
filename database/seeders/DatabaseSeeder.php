<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\Category;
use App\Models\Parameter;
use App\Models\Store;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        ######################## generation data with Seeder #######################

        //generation Store data with seeder
         $this->call(StoreSeeder::class);

        //generation Category data with seeder
        $this->call(CategorySeeder::class);

        //generation Attributes data with seeder
        $this->call(AttributeSeeder::class);

        //generation Parameters data with seeder
        $this->call(ParameterSeeder::class);

        //generation Product data with seeder
         $this->call(ProductSeeder::class);

        ######################## End generation data with Seeder #######################

    }
}
