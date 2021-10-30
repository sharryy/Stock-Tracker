<?php

namespace App\Clients;

use App\Models\Stock;
use Illuminate\Support\Facades\Http;

class BestBuy implements Client
{
    public function checkAvailability(Stock $stock): StockStatus
    {
        $url = 'https://api.bestbuy.com/v1/products/6401728.json?apiKey='. env('BEST_BUY_API_KEY');
        $results = Http::get($url)->json();
        return new StockStatus(
            $results['available'],
            $results['price']
        );
    }
}
