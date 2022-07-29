<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\Bill;

class StudentBill extends Model
{

    use HasFactory;

    protected $table = 'student_bills';

    protected $fillable = ['status', 'student_id', 'bill_id', 'year'];

    protected $hidden = ['student_id', 'bill_id'];

    protected $appends = [
        'student_name',
        'bill_name',
    ];


    public function getStudentNameAttribute($value)
    {
        return  Student::find($this->student_id)->name;
    }

    public function getBillNameAttribute($value)
    {
        return  Bill::find($this->bill_id)->name;
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }
}
