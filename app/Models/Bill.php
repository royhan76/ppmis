<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;

class Bill extends Model
{
    protected $fillable = ['name', 'arrival', 'year', 'nominal', 'role_id'];
    protected $hidden = ['role_id', 'created_at', 'updated_at'];
    protected $appends = ['role_name'];

    public function getRoleNameAttribute($value){
        return Role::find($this->role_id)->name;
    }
    use HasFactory;

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
