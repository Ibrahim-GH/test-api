<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $storesIds = Store::all()->pluck('id')->toArray();
        return [
            // generation Category data with factory and faker library
            'name' => $this->faker->name(),
            'store_id' => $this->faker->randomElement($storesIds),
        ];
    }
}
