<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $storesIds = Store::all()->pluck('id')->toArray();
        $categoriesIds = Category::all()->pluck('id')->toArray();
        return [
            // generation Product data with factory and faker library
            'name' => $this->faker->name(),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomDigit(),
            'quantity' => $this->faker->randomDigit(),
            'store_id' => $this->faker->randomElement($storesIds),
            'category_id' => $this->faker->randomElement($categoriesIds),
        ];
    }
}
