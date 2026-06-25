<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'category_id',
        'item_code',
        'name',
        'stock',
        'price',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'stock' => 'integer',
        'price' => 'integer',
    ];

    /**
     * Get the category that owns the item.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get formatted price in Rupiah.
     */
    public function getPriceFormattedAttribute()
    {
        return 'Rp '.number_format($this->price, 0, ',', '.');
    }

    /**
     * Scope a query to only include items with low stock.
     */
    public function scopeLowStock($query, $threshold = 10)
    {
        return $query->where('stock', '<', $threshold);
    }
}
