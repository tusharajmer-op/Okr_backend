<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjectDepartmentMapping extends Model
{
    use HasFactory;
    protected $table = "object_department_mapping";
    protected $fillable = [
        "object_id",
        "department_id"
    ];
    public $timestamps = false;

    public function objectDepartment()
    {
        return $this->belongsTo(Objects::class, "object_id", "id");
    }
    public function objectDepartmentList()
    {
        return $this->belongsTo(Department::class, "department_id", "id");
    }
}
