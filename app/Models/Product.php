<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Mass assignable fields (include image_url)
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'eco_friendly',
        'image_url' => 'd14934045f6dfcd2e7415d39d16f774d.jpg',
    ];

    // Relationship with reviews
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Calculate the average rating for a product
    public function averageRating()
    {
        return $this->reviews()->avg('rating');
    }

    // Check if the product is in stock
    public function isInStock()
    {
        return $this->stock > 0;
    }

    // Check if the product is running low on stock
    public function isLowStock()
    {
        return $this->stock <= 5;
    }

    // Return eco-friendly status
    public function ecoFriendly()
    {
        return $this->eco_friendly;
    }

    public function carts()
    {
        return $this->hasMany(Cart::class, 'product_id');
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id');
    }
}
