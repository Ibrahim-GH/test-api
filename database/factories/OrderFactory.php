<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // generation order data with factory and faker library
            'status' => $this->faker->randomElement($array = array('pending', 'processing', 'completed', 'decline')),
            'order_number' => $this->faker->numberBetween($int1 = 1, $int2 = 100),
            'item_count' => $this->faker->numberBetween($int1 = 1, $int2 = 100),
            'note' => $this->faker->paragraph(),
            'user_id' => User::factory(),
        ];
    }
}
