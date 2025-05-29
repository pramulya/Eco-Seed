<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'amount',
        'payment_method',
    ];
}
