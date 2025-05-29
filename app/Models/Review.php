<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    // Mass assignable fields
    protected $fillable = [
        'product_id',
        'reviewer_name',
        'review',
        'rating',
    ];

    // A review belongs to a product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
