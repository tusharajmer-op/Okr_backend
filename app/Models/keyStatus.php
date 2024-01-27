<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class keyStatus extends Model
{
    use HasFactory;
    protected $table = "keys_status";
    protected $fillable = [
        'name',
    ];

}
