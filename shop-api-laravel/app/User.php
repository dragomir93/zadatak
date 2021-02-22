<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    protected $primaryKey = 'id';
    protected $table = 'user';
    protected $guarded = array();
    public $timestamps = false;

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_name','name','surname', 'email', 'password','confirm_password','active','api_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function scopeMailExists($query, $email)
    {
        return $query->where('Email', $email)->exists();
    }

    public function scopeTokenExists($query, $token)
    {
        return $query->where('api_token', $token)->exists();
    }

    public function refreshToken()
    {
        $this->api_token = self::createToken();
        $this->save();
    }

    public static function createToken()
    {
        $token = Str::random(60);
        
        if (User::tokenExists($token)) {
            $token = Str::random(60);
        }
        
        return $token;
    }
}
