<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'category', 'type', 'location', 'description',
        'price', 'unit', 'stock', 'rating', 'review_count', 'is_featured',
        'image', 'tags', 'source_name',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected $casts = [
        'price' => 'decimal:2',
        'rating' => 'decimal:1',
        'is_featured' => 'boolean',
        'tags' => 'array',
    ];

    protected $appends = ['is_available', 'formatted_price'];

    public function getIsAvailableAttribute(): bool
    {
        return $this->stock > 0;
    }

    public function getFormattedPriceAttribute(): string
    {
        return '৳' . number_format((float) $this->price, 0);
    }
}
