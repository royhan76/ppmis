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
        'grade_name',
    ];

    protected $hidden = [
        'user_id',
        'grade_id',
        'created_at',
        'updated_at'
    ];


    public function getGradeNameAttribute($value)
    {
        return Grade::find($this->grade_id)->name;
    }

    public function getNameAttribute($value)
    {
        $user = User::find($this->user_id);
        if ($user == null) return null;
        return $user;
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
