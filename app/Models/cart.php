<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';
    protected $primaryKey = 'cartId';
    public $timestamps = true;

    protected $fillable = ['product_id', 'user_id', 'quantity', 'total_price'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}

