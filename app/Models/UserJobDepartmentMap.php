<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserJobDepartmentMap extends Model
{
    use HasFactory;
    protected $table = 'user_job_department_map';
    protected $fillable = [
        'user_id',
        'job_id',
        'department_id',
        'start_date',
        'end_date'
    ];
    public function job()
    {
        return $this->belongsTo(Jobs::class, 'job_id', 'id');
    }

    
    
}
