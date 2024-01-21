<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class keySubTypes extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'keytype_id',
    ];
    public function keyType()
    {
        return $this->nebelongsTo(keyTypes::class);
    }

}
