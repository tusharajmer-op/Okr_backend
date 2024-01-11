<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRoleDepartmentMap extends Model
{
    use HasFactory;
    protected $table = 'user_department_role_map';
    protected $fillable = [
        'user_id',
        'role_id',
        'department_id',
    ];
    public function role()
    {
        return $this->belongsTo(Roles::class, 'role_id', 'id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }
}
