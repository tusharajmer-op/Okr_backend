<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserDepartmentJobMap;

class Department extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'short_name',
        'description'
    ];
    public function userDepartmentJobMap()
    {
        return $this->hasMany(UserJobDepartmentMap::class,'department_id');
    }
    public function userRoleDepartmentMap()
    {
        return $this->hasMany(UserRoleDepartmentMap::class,'department_id');
    }
    public function userObjectDepartmentMap()
    
    {
        return $this->hasMany(ObjectDepartmentMapping::class,'department_id')->count();
    }
    public function userObjectDepartmentMap1()
    
    {
        return $this->belongsToMany(ObjectDepartmentMapping::class,'department_id');
    }
}
