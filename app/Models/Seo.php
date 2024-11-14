<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    protected $fillable = [
        'meta_title',
        'meta_author',
        'meta_tag',
        'meta_description',
        'meta_keyword',
        'google_verification',
        'alexa_verification',
        'google_analytics',
        'google_adsense',
    ];    
}
