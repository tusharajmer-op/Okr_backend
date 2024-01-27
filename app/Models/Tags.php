<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    use HasFactory;
    protected $table = 'tags';
    protected $fillable = ['tag'];
    protected $hidden = ['created_at','updated_at'];
    public function objectTagMapping()
    {
        return $this->hasMany(ObjectTagMapping::class, "tag_id", "id");
    }
    public function keystotags()
    {
        return $this->hasMany(keystotags::class, "tag_id", "id");
    }
}
