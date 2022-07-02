<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;

class Bill extends Model
{
    protected $fillable = ['name', 'arrival', 'year', 'nominal', 'role_id'];
    use HasFactory;

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
