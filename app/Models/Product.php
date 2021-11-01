<?php

namespace App\Models;

use App\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    public function track()
    {
        $this->stock->each->track(function ($stock) {
            $this->recordHistory($stock);
        });
    }

    public function inStock()
    {
        return $this->stock()->where('in_stock', true)->exists();
    }

    public function stock()
    {
        return $this->hasMany(Stock::class);
    }

    public function history()
    {
        return $this->hasMany(History::class);
    }

    public function recordHistory(Stock $stock)
    {
        $this->history()->create([
            'price' => $stock->price,
            'in_stock' => $stock->in_stock,
            'stock_id' => $stock->id,
        ]);
    }
}
