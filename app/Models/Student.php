<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;
use App\Models\User;
use App\Models\Grade;
use App\Models\Season;
use App\Models\Room;
use App\Models\LessonValue;

class Student extends Model
{

    use HasFactory;

    protected $fillable = [
        'name',
        'nomor_induk_santri',
        'date_birth',
        'address',
        'arrival',
        'year',
    ];


    protected $appends = [
        'image_url',
        'room_name',
        'dormitory_name',
        'grade_name',
        'role_name',
        'fouls',
        'bills',
        'lesson_values'
    ];

    protected $hidden = [
        'user_id',
        'grade_id',
        'room_id',
        'role_id',
        'image',
        'created_at',
        'updated_at'
    ];

    public function getLessonValuesAttribute($value)
    {
        return LessonValue::where('student_id', $this->id)->get();
    }

    public function getBillsAttribute($value)
    {
        return StudentBill::where(['student_id' =>  $this->id, 'year' => $this->year])->get();
    }

    public function getFoulsAttribute($value)
    {
        return Foul::where('student_id', $this->id)->get();
    }

    public function getImageUrlAttribute($value)
    {
        if (!$this->image) return null;
        $url = 'https://' . env('AWS_BUCKET') . '.s3-' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/ppmis/images/student/';
        return $url . $this->image;
    }

    public function getRoomNameAttribute($value)
    {
        return  Room::find($this->room_id)->name;
    }

    public function getDormitoryNameAttribute($value)
    {
        return  Room::find($this->room_id)->dormitory->name;
    }

    public function getGradeNameAttribute($value)
    {
        return  Grade::find($this->grade_id)->name;
    }

    public function getRoleNameAttribute($value)
    {
        return  Role::find($this->role_id)->name;
    }

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

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
}
