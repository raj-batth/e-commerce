<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        return [
            'name'          => $this->faker->unique()->sentence($nbWords = 1, $variableNbWords = true),
            'description'   => $this->faker->sentence($nbWords = 5, $variableNbWords = true),
            'quantity'      => $this->faker->numberBetween(1, 10),
            'image'         => $this->faker->randomElement(['1.jpg', '2.jpg', '3.jpg']),
            'price'         => $this->faker->randomFloat(2, 1, 100),
        ];
    }
}
