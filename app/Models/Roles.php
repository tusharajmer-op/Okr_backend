<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'short_name',
        'description'
    ];
    public function userRoleDepartmentMap()
    {
        return $this->hasMany(UserRoleDepartmentMap::class,'role_id');
    }
}
