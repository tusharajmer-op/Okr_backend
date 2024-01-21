<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjectownerMapping extends Model
{
    use HasFactory;
    protected $table = "object_owner_mapping";
    protected $fillable = [
        "object_id",
        "owner_id"
    ];
    public $timestamps = false;

    public function objectOwner()
    {
        return $this->belongsTo(Objects::class, "object_id", "id");
    }
    public function objectOwnerList()
    {
        return $this->belongsTo(User::class, "owner_id", "id");
    }
}
