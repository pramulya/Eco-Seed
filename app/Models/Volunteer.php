<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    protected $fillable = ['campaign_id', 'name', 'email', 'phone'];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}

