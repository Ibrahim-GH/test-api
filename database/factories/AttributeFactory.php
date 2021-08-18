<?php

namespace Database\Factories;

use App\Models\Attribute;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttributeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Attribute::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $categoriesIds = Category::all()->pluck('id')->toArray();
        return [
            // generation Attribute data with factory and faker library
            'name' => $this->faker->name(),
            'is_required' => $this->faker->boolean(),
            'category_id' => $this->faker->randomElement($categoriesIds),
        ];
    }
}
