<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjectVisibilityListMapping extends Model
{
    use HasFactory;

    protected $table = "object_visibility_list_mapping";
    protected $fillable = [
        "object_id",
        "user_id"
    ];
    public $timestamps = false;

    public function objectVisibilityList()
    {
        return $this->belongsTo(Objects::class, "object_id", "id");
    }
    public function objectVisibilityListUser()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }

}
