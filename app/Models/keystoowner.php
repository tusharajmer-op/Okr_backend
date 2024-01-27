<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class keystoowner extends Model
{
    use HasFactory;
    protected $table = "key_owner_mapping";
    protected $fillable = [
        'key_id',
        'owner_id',
    ];
    public function keys(){
        return $this->belongsTo(keys::class);

    }
    public function owners(){
        return $this->belongsTo(user::class);
    }
}
