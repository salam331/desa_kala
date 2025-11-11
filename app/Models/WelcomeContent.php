<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WelcomeContent extends Model
{
    protected $fillable = [
        'village_name',
        'hero_title',
        'hero_description',
        'hero_button_text',
        'hero_button_link',
        'hero_background_image',
        'profile_title',
        'profile_description',
        'location_title',
        'location_description',
        'agriculture_title',
        'agriculture_description',
        'culture_title',
        'culture_description',
        'footer_text',
    ];
}
