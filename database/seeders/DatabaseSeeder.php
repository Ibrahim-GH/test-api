<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\Category;
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
        // generation Category data with factory
        //Category::factory(10)->create();

        // generation Attribute data with factory
        //Attribute::factory(10)->create();

        ######################## End generation data with Factories #######################


        ######################## generation data with Seeder #######################
        //generation Category data with seeder
        $this->call(CategorySeeder::class);

        //generation Category data with seeder
        $this->call(AttributeSeeder::class);

        ######################## End generation data with Seeder #######################

    }
}
