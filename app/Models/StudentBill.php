<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\Bill;

class StudentBill extends Model
{
    protected $fillable = ['student_id', 'bill_id', 'status'];
    use HasFactory;

    protected $table = 'student_bills';

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }
}
