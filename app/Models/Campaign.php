<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = ['title', 'description', 'image_path', 'year'];

    public function volunteers()
    {
        return $this->hasMany(Volunteer::class);
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }
}
