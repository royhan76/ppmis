<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Grade;
use App\Models\Season;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'grade_id',
        'year',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function Grade()
    {
        return $this->belongsTo(Grade::class);
    }
}
