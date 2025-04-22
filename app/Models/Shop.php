<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $table = 'shops';

    protected $fillable = ['shop_name', 'shop_description'];

    public function products()
    {
        return $this->hasMany(Product::class, 'shop_id');
    }
}

