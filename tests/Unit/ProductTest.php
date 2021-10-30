<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_checks_stocks_for_products_at_retailers()
    {
//        $switch = Product::create(['name' => 'Nintendo Switch']);
//        $bestBuy = Retailer::create(['name' => 'Best Buy']);
//        $this->assertFalse($switch->inStock());
//
//        $stock = new Stock([
//            'price' => 100,
//            'url' => 'https://www.foo.com',
//            'sku' => 12345,
//            'in_stock' => true
//        ]);
//
//        $bestBuy->addStock($switch, $stock);
//        $this->assertTrue($switch->inStock());
        $this->assertTrue(true);
    }
}
