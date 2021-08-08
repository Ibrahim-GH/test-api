<?php

namespace Database\Seeders;

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

        // generation Category data with factory
        Category::factory(10)->create();


        //generation Category data with seeder
        $this->call(CategorySeeder::class);



    }
}
