<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class keystofrequencies extends Model
{
    use HasFactory;
    protected $table = "key_frequency_mapping";
    protected $fillable = [
        'key_id',
        'frequency_id',
    ];
    public function keys(){
        return $this->belongsTo(keys::class);
    }
    public function frequencies(){
        return $this->belongsTo(CheckInFrequency::class);
    }
    
}
