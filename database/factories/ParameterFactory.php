<?php

namespace Database\Factories;

use App\Models\Attribute;
use App\Models\Parameter;
use Illuminate\Database\Eloquent\Factories\Factory;

class ParameterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Parameter::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $attributesIds = Attribute::all()->pluck('id')->toArray();
        return [
            // generation Parameters data with factory and faker library
            'name' => $this->faker->name(),
            'attribute_id'=> $this->faker->randomElement($attributesIds)
        ];
    }
}
