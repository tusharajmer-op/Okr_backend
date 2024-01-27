<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class keyTypes extends Model
{
    use HasFactory;
    protected $table = "keytypes";
    protected $fillable = [
        'name',
    ];
    public function keySubTypes()
    {
        return $this->hasMany(keySubTypes::class);
    }
}
