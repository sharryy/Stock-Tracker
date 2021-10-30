<?php

namespace App\Clients;

use App\Models\Stock;
use Illuminate\Support\Facades\Http;

class BestBuy implements Client
{
    public function checkAvailability(Stock $stock): StockStatus
    {
        $url = $this->endPoint($stock->sku);
        $results = Http::get($url)->json();
        return new StockStatus(
            $results['onlineAvailability'],
            $results['salePrice']
        );
    }

    public function endPoint($sku): string
    {
        $apiKey = config('services.clients.bestBuy.key');
        return "https://api.bestbuy.com/v1/products/{$sku}.json?apiKey={$apiKey}";
    }
}
