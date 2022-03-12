<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slideshow extends Model
{
    use HasFactory;
    protected $fillable = ['image', 'order'];
    protected $appends = ['image_url'];
    public function getImageUrlAttribute($value)
    {
        $url = 'https://' . env('AWS_BUCKET') . '.s3-' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/ppmis/images/slideshow/';
        return $url . $this->image;
    }
}
