<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjectTagMapping extends Model
{
    use HasFactory;
    protected $table = "object_tags_mapping";
    protected $fillable = [
        "object_id",
        "tag_id"
    ];
    public $timestamps = false;

    public function objectTag()
    {
        return $this->belongsTo(Objects::class, "object_id", "id");
    }
    public function objectTagList()
    {
        return $this->belongsTo(Tags::class, "tag_id", "id");
    }
}
