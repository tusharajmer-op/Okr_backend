<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objects extends Model
{
    use HasFactory;
    protected $table = "objects";
    protected $fillable = [
        "object_name",
        "object_type",
        "object_description",
        "object_status",
        "object_visibility",
        "created_by",
        "department_id"
    ];
    public function objectTagMapping()
    {
        return $this->hasMany(ObjectTagMapping::class, "object_id", "id");
    }
    public function objectCategoryMapping()
    {
        return $this->hasOne(ObjectCategoryMapping::class, "object_id", "id");
    }
    public function objectDepartmentMapping()
    {
        return $this->hasOne(ObjectDepartmentMapping::class, "object_id", "id");
    }
    public function objectOwnerMapping()
    {
        return $this->hasMany(ObjectownerMapping::class, "object_id", "id");
    }
    public function objectVisbilityListMapping()
    {
        return $this->hasMany(ObjectVisibilityListMapping::class, "object_id", "id");
    }
    public function objectDepartmentMappingList()
    {
        return $this->hasOne(Department::class, "id", "department_id");
    }
    public function objectCreatedByMapping()
    {
        return $this->hasOne(User::class, "id", "created_by");
    }
}
