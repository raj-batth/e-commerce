<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\ShippingDetail;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ShippingDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ShippingDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_id'      => Order::all()->random()->id,
            'first_name'    => $this->faker->firstName,
            'last_name'     => $this->faker->LastName,
            'address'       => $this->faker->streetAddress,
            'city'          => $this->faker->city,
            'state'         => $this->faker->state,
            'postal_code'   => $this->faker->postcode
        ];
    }
}
