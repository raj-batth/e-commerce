<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function dashboardLoadsCorrectly() {
        $response = $this->get('/');
        $response->assertOK();
        $response->assertSeeText('Online-Store', $escaped = true);
    }

    /** @test */
    public function unAuthorizedPersonCanNotSeePurchaseButton() {
        $this->withoutExceptionHandling();
        $product = Product::factory()->count(20)->create();
        $response = $this->get('/');
        $response->assertDontSeeText('Purchase', $escaped = true);
    }
    
    /** @test */
    public function authorizedPersonCanSeePurchaseButton() {
        $this->actingAs(User::factory()->make());
        $product =  Product::factory()->count(8)->create();
        $response = $this->get('/');
        $response->assertSeeText('Purchase', $escaped = true);
    }

    /** @test */
    public function pagination() {
        $this->createMultipleProduct(1);
        $response = $this->get('/');
        $response->assertSee('Product1', $escaped = true);
        $response->assertSee('Product8', $escaped = true);
        $response = $this->get('/?page=2');
        $response->assertSee('Product9', $escaped = true);
        $response->assertSee('Product16', $escaped = true);
    }

    /** @test */
    public function sortPriceAsc() {
        $this->createMultipleProduct(5);
        $response = $this->get('/?sort=asc');
        $response->assertSeeInOrder(['Product5', 'Product10', 'Product15'], $escaped = true);
    }

    /** @test */
    public function sortPriceDesc() {
        $this->createMultipleProduct(5);
        $response = $this->get('/?sort=desc');
        $response->assertSeeInOrder(['Product15', 'Product10', 'Product5'], $escaped = true);
    }

    private function createMultipleProduct($startAndIncrementalValue) {
        for ($i = $startAndIncrementalValue; $i <= 16; $i = $i + $startAndIncrementalValue) {
            $product = Product::factory()->create([
                'name' => 'Product' . $i,
                'price' => $i
            ]);
        }
    }
}
