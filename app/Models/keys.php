<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class keys extends Model
{
    use HasFactory;
    protected $table = "keys";
    protected $fillable = [
        'name',
        'keysubtype_id',
        'description',
        'cascade_approach_id',
    ];
    public function keySubType()
    {
        return $this->belongsTo(keySubTypes::class);
    }
    public function cascadeApproach()
    {
        return $this->belongsTo(CascadeApproach::class);
    }
    public function checkInFrequency()
    {
        return $this->belongsTo(CheckInFrequency::class);
    }
    public function keysToObjects()
    {
        return $this->hasMany(keysToObjects::class);
    }
    public function keysToTags()
    {
        return $this->hasMany(keysToTags::class);
    }
}
