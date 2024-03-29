<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Laravel\Sanctum\HasApiTokens;
use App\Models\UserDepartmentJobMap;
use App\Models\userFollowedOkrs;
class User extends Authenticatable implements JWTSubject
{
    

    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'birthdate'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function roles()
    {
        return $this->hasOne(UserRoleDepartmentMap::class, 'user_id', 'id');
    }

    public function jobs()
    {
        return $this->hasOne(UserJobDepartmentMap::class, 'user_id', 'id');
    }
    

    public function userRoleDepartmentMap()
    {
        return $this->hasOne(UserRoleDepartmentMap::class,'user_id','id');
    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
    public function userObjectOwnerMap()
    {
        return $this->hasMany(ObjectownerMapping::class,'user_id','id');
    }
    public function userObjectVisibilityMap()
    {
        return $this->hasMany(ObjectVisibilityListMapping::class,'user_id','id');
    }
    public function userObjectCreatedByMap()
    {
        return $this->belongsTo(Objects::class,'user_id','id');
    }
    public function userFollowedOkrs()
    {
        return $this->hasMany(userFollowedOkrs::class,'user_id','id');
    }
    public function ownerKeysMapping(){
        return $this->hasMany(keystoowner::class,'owner_id','id');
    }
}
