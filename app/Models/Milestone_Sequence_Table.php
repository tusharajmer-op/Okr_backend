<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Milestone_Sequence_Table extends Model
{
    use HasFactory;
    protected $fillable = [
        'sequence',
        'start',
        'end',
        'increment',
        'milestone__sequence__templates_id',
    ];
    public function milestone__sequence__templates()
    {
        return $this->belongsTo(Milestone_Sequence_Templates::class, 'milestone__sequence__templates_id', 'id');
    }
}
