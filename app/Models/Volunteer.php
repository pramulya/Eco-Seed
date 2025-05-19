<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'motivation',
        'availability',
        'skills',
        'campaign_id'
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}