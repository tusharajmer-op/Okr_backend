<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class keystotags extends Model
{
    use HasFactory;
    protected $table = "tags_mapping";
    protected $fillable = [
        'key_id',
        'tag_id',
    ];
    public function tags(){
        return $this->belongsTo(tags::class);
    }
    public function keys(){
        return $this->belongsTo(keys::class);
    }
}
