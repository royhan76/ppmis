<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Grade;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'grade_id', 'year'];
    protected $hidden = ['created_at', 'updated_at', 'grade_id'];
    protected $appends = ['grade_name'];

    public function getGradeNameAttribute($value)
    {
        return Grade::find($this->grade_id)->name;
    }

    public function Grade()
    {
        return $this->belongsTo(Grade::class);
    }
}
