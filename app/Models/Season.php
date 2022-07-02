<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    protected $fillable = ['year'];
    use HasFactory;

    protected $primaryKey = 'year';
    public $incrementing = false;
}
