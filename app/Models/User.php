<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Profile;
use App\models\Role;
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'provider_id',
        'password',
        'user_type',
        'banned_until',
    ];

    protected $dates = [
        'banned_until'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
    public function events()
    {
        return $this->hasMany(Event::class);
    }
    public function favourites(){
        return $this->belongsToMany(Event::class,'favourites','user_id','event_id')->withTimestamps();
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
   
}
