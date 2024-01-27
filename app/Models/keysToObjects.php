<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class keysToObjects extends Model
{
    use HasFactory;
    protected $table = "keys_to_objects";
    protected $fillable = [
        'key_id',
        'object_id',
    ];
    public function objects()
    {
        return $this->belongsTo(objects::class);
    }
    public function keys()
    {
        return $this->belongsTo(keys::class);
    }
    
}
