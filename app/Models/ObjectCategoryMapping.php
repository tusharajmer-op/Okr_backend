<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjectCategoryMapping extends Model
{
    use HasFactory;
    protected $table = "object_category_mapping";
    protected $fillable = [
        "object_id",
        "category_id"
    ];
    public $timestamps = false;

    public function objectCategory()
    {
        return $this->belongsTo(Objects::class, "object_id", "id");
    }
    public function objectCategoryList()
    {
        return $this->belongsTo(OkrCategory::class, "category_id", "id");
    }
}
