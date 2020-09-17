<?php

namespace Tests\Feature;

// use Faker\Factory;

use App\Http\Requests\Order\OrderStoreRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\ShippingDetail;
use App\Models\User;
use Illuminate\Foundation\Testing\Concerns\InteractsWithExceptionHandling;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PDO;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;
    private $validRules;

    protected function setUp(): void {
        parent::setUp();

        $this->validRules = new OrderStoreRequest();
    }

    /** @test */
    public function onlyLoggedInUserCanOrder() {
        $response = $this->get('/ordersummary')->assertRedirect('/login');
    }

    /** @test */
    public function authenticatedUserCanOrder() {
        $this->actingAs(User::factory()->make());
        $response = $this->get('/ordersummary')
            ->assertOk();
    }

    /** @test */
    public function insertIntoDB() {
        User::factory()->count(3)->create();
        Product::factory()->count(2)->create();
        Order::factory()->count(4)->create();
        ShippingDetail::factory()->count(4)->create();
        $this->assertDatabaseCount('orders', 4);
        $this->assertDatabaseCount('shipping_details', 4);
        $this->assertDatabaseCount('products', 2);
        $this->assertDatabaseCount('users', 3);
    }

    /** @test */
    public function orderStoreFunction() {
        $this->withoutExceptionHandling();
        $user = $this->actingAs(User::factory()->create());
        $product = Product::factory()->create([
            'quantity' => 1
        ]);
        $response = $this->post('/thankyou', [
            'first_name'    => "TestF",
            'last_name'     => "TestL",
            'address'       => "TestAddress",
            'city'          => 'TestCity',
            'state'         => 'TestState',
            'postal_code'   => 'TestP',
            'user_id'       => 1,
            'product_id'    => 1,
            'price'         => 13,
            'tax'           => 13,
            'total_amount'  => 20
        ]);
        $this->assertDatabaseCount('orders', 1);
        $this->assertDatabaseCount('shipping_details', 1);
        $this->assertDatabaseHas('products', [
            'quantity' => 0,
        ]);
    }

    /** @test */
    public function orderValidations() {
        $this->assertEquals(
            [
                'first_name' => 'bail|required|string|min:2',
                'last_name' => 'bail|required|string|min:2',
                'address' => 'bail|required|string',
                'city' => 'bail|required|string',
                'state' => 'bail|required|string',
                'postal_code' => 'bail|required|string'
            ],
            $this->validRules->rules()
        );
    }
}
