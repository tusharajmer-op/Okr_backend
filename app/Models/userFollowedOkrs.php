<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userFollowedOkrs extends Model
{
    use HasFactory;
    protected $table = "user_followed_objectives";
    protected $fillable = [
        "user_id",
        "objective_id"
    ];
    public function user()
    {
        return $this->hasOne(User::class, "id", "user_id");
    }
    public function objective()
    {
        return $this->hasOne(Objects::class, "id", "objective_id");
    }
}
