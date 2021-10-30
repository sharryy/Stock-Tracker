<?php

namespace Tests\Feature;

use App\Models\Product;
use Database\Seeders\RetailerWithProductSeeder;
use Http;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TrackCommandTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_tracks_product_stock()
    {
        $this->seed(RetailerWithProductSeeder::class);

        $this->assertFalse(Product::first()->inStock());
        Http::fake(function () {
            return [
                'available' => true,
                'price' => 12900
            ];
        });
        $this->artisan('track')->expectsOutput("All Done");
        $this->assertTrue(Product::first()->inStock());
    }
}
