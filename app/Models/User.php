<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
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
        'telephone',
        'password',
        'imagen_path',
        'numberDaysSuscripted',
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
    ];

    public function articles()
    {
        return $this->hasMany('App\Models\Article');
    }

    public function access()
    {
        return $this->belongsToMany('App\Models\Article')->withTimestamps()->using('App\Models\Article_user');
    }

    public function valoration()
    {
        return $this->hasMany('App\Models\Valoration');
    }

    public function reward()
    {
        return $this->hasMany('App\Models\Reward');
    }

    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction');
    }
}
