<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OkrCategory extends Model
{
    use HasFactory;
    protected $table = 'okr_category';
    protected $fillable = ['category'];
    protected $hidden = ['created_at','updated_at'];
    public function okrCategoryMapping()
    {
        return $this->hasMany(ObjectCategoryMapping::class, "category_id", "id");
    }
    public function okrCategoryMappingList()
    {
        return $this->hasMany(ObjectCategoryMapping::class, "category_id", "id");
    }
}
