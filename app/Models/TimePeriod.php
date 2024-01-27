<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimePeriod extends Model
{
    use HasFactory;
    protected $table = 'time_period';
    protected $fillable = ['year','quarter'];
    protected $hidden = ['created_at','updated_at'];

    public function objectives()
    {
        return $this->hasMany(Objects::class,"id");
    }




}
