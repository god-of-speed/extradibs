<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    //list fillable
    protected $fillable = ['name','price','description','image'];


    /**
     * get accounts
     */
    public function accounts() {
        return $this->hasMany('App\UserPackage');
    }
}
