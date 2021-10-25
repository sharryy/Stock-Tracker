<?php

namespace Tests\Feature;

use App\Models\Product;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /** @test */
    public function it_checks_stocks_for_products_at_retailers()
    {
        $switch = Product::create(['name' => 'Nintendo Switch']);
        $bestBuy = Retailer::create(['name' => 'Best Buy']);
        $this->assertFalse($switch->inStock());
    }
}
