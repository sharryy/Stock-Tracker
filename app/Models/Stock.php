<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $table = 'stock';

    protected $casts = [
        'in_stock' => 'boolean'
    ];

    public function track()
    {
        $class = "App\\Clients\\" . \Str::studly($this->retailer->name);
        $status = (new $class)->checkAvailability($this);

        $this->update([
            'in_stock' => $status->available,
            'price' => $status->price
        ]);
    }

    public function retailer()
    {
        return $this->belongsTo(Retailer::class);
    }
}
