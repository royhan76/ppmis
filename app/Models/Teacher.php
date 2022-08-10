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
        'id',
        'user_id',
        'grade_id',
        'year',
    ];

    protected $appends = [
        'name',
    ];


    public function getNameAttribute($value)
    {
        return User::find($this->user_id)->name;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
}
