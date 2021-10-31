<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Retailer;
use App\Models\Stock;
use Illuminate\Database\Seeder;

class RetailerWithProductSeeder extends Seeder
{
    public function run()
    {
        $switch = Product::create(['name' => 'Nintendo Switch']);
        $bestBuy = Retailer::create(['name' => 'Best Buy']);
        $bestBuy->addStock($switch, new Stock([
            'price' => 100,
            'url' => 'https://www.foo.com',
            'sku' => 12345,
            'in_stock' => false
        ]));
    }
}
