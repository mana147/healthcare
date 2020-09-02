<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    protected $guarded = [];
    // protected $fillable = ['id','iduserhw','name','email'];
    protected $hidden = ['password', 'remember_token'];
    protected $casts = ['email_verified_at' => 'datetime'];

    // public $timestamps = false;

    public function sokhambenh()
    {
        return $this->hasMany('App\Sokhambenh','user_id','id');
    }
}

