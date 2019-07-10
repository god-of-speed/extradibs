<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstName', 'lastName','username','phone','password','referredBy','image','ref','bankName','accountName','accountNumber','potential','blocked'
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
     * get all packages by user
     */
    public function accounts() {
        return $this->hasMany('App\UserPackage');
    }

    /**
     * get report
     */
    public function reports() {
        return $this->hasMany('App\Report');
    }

}
