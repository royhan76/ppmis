<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;
use App\Models\User;
use App\Models\Grade;
use App\Models\Season;
use App\Models\Room;

class Student extends Model
{
    protected $fillable = [
        'name',
        'nomor_induk_santri',
        'date_birth',
        'image',
        'address',
        'arrival',
        'room_id',
        'role_id',
        'year',
        'user_id',
        'grade_id'
    ];
    protected $appends = ['image_url'];
    public function getImageUrlAttribute($value)
    {
        $url = 'https://' . env('AWS_BUCKET') . '.s3-' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/ppmis/images/student/';
        return $url . $this->image;
    }
    use HasFactory;

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function season()
    {
        return $this->belongsTo(Season::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function Grade()
    {
        return $this->belongsTo(Grade::class);
    }
}
