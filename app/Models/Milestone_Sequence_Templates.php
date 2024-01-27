<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Milestone_Sequence_Templates extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];
    public function sequence()
    {
        return $this->hasMany(Milestone_Sequence_Table::class, 'id');
    }
}
