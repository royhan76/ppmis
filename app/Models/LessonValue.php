<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\Lesson;
use App\Models\Grade;

class LessonValue extends Model
{
    use HasFactory;
    protected $table = 'lesson_values';

    protected $fillable = [
        'year',
        'value',
        'student_id',
        'lesson_id',
        'student_id',
        'grade_id'
    ];


    protected $appends = [
        'student_name',
        'lesson_name',
        'grade_name'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',

    ];

    public function getGradeNameAttribute($value)
    {
        return Grade::find($this->grade_id)->name;
    }

    public function getStudentNameAttribute($value)
    {
        return Student::find($this->student_id)->name;
    }

    public function getLessonNameAttribute($value)
    {
        return Lesson::find($this->lesson_id)->name;
    }
}
