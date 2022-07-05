<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;

class Foul extends Model
{
    
    use HasFactory;

    protected $fillable = ['name', 'date']; 

    protected $hidden = ['student_id'];

    protected $appends = ['student_name'];

    public function getStudentNameAttribute($value){
        return Student::find($this->student_id)->name;
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
