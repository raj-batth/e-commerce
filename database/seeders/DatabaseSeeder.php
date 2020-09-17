<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use App\Models\ShippingDetail;
use App\Models\User;
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
        User::factory(5)->create();
        Product::factory(20)->create();
        Order::factory(10)->create();
        ShippingDetail::factory(10)->create();
    }
}
