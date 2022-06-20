<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Dormitory;

class Room extends Model
{
    protected $fillable = ['name', 'dormitory_id'];
    use HasFactory;

    public function dormitory()
    {
        return $this->belongsTo(Dormitory::class);
    }
}
