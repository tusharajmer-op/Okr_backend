<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserDepartmentJobMap; 

class Jobs extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'short_name',
        'description'
    ];
    public function userDepartmentJobMap()
    {
        return $this->hasMany(UserJobDepartmentMap::class,'job_id');
    }
}
