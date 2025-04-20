<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = [
        'campaign_name',
        'campaign_type',
        'campaign_category',
        'campaign_organizer',
        'campaign_start_date',
        'campaign_end_date',
        'campaign_target',
        'campaign_description',
        'image_path',
        'year'
    ];
}
