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
        // \App\Models\User::factory(10)->create();

        ######################## generation data with Factories #######################
        //if you want to generate data with factory .. do make comment on code

        // generation Store data with factory
        //Store::factory(10)->create();

        // generation Category data with factory
        Category::factory(10)->create();

        // generation Attribute data with factory
        Attribute::factory(10)->create();

        // generation Attribute data with factory
        Parameter::factory(10)->create();

        // generation Product data with factory
        //Product::factory(10)->create();

        ######################## End generation data with Factories #######################


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
