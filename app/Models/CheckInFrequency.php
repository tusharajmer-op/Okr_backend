<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckInFrequency extends Model
{
    use HasFactory;
    protected $table = "check_in_frequencies";
    protected $fillable = [
        'name',
    ];
    public function keystofrequencies(){
        return $this->hasMany(keystofrequencies::class);
    }
    
}
