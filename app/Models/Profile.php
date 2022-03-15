<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $appends = ['logo_url', 'image_url', 'registration_url'];
    public function getLogoUrlAttribute($value)
    {
        $url = 'https://' . env('AWS_BUCKET') . '.s3-' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/ppmis/images/profile/';
        return $url . $this->logo;
    }

    public function getImageUrlAttribute($value)
    {
        $url = 'https://' . env('AWS_BUCKET') . '.s3-' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/ppmis/images/profile/';
        return $url . $this->image;
    }

    public function getRegistrationUrlAttribute($value)
    {
        $url = 'https://' . env('AWS_BUCKET') . '.s3-' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/ppmis/images/profile/';
        return $url . $this->registration;
    }
}
