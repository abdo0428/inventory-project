<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'sku', 'name', 'description', 'quantity', 'low_stock_threshold',
    ];

    public function transactions()
    {
        return $this->hasMany(StockTransaction::class);
    }

    public function getIsLowStockAttribute(): bool
    {
        return $this->quantity <= $this->low_stock_threshold;
    }
}