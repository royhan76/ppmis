<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Grade;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'grade_id', 'year'];

    public function Grade()
    {
        return $this->belongsTo(Grade::class);
    }
}
