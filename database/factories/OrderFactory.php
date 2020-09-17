<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            'user_id'       => User::all()->random()->id,
            'product_id'    => Product::all()->random()->id,
            'price'         => function (array $attributes) {
                return Product::find($attributes['product_id'])->price;
            },
            'tax'           => 13,
            'total_amount'  => function (array $attributes) {
                return (Product::find($attributes['product_id'])->price * 13 / 100) + Product::find($attributes['product_id'])->price;
            },
        ];
    }
}
