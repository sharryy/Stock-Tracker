<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Retailer;
use App\Models\Stock;
use Http;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TrackCommandTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_tracks_product_stock()
    {
        Http::fake(function () {
            return [
                'available' => true,
                'price' => 12900
            ];
        });
        $this->artisan('track');
        $this->assertTrue($stock->fresh()->in_stock);
    }
}
