<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPackage extends Model
{
    //create fillable
    protected $fillable = ['userId','packageId','paid','merged',
        'startDate','numberOfInvestments','payers','ref','numberOfReferrals'
    ]; 

    /**
     * get user by userId
     */
    public function user() {
        return $this->belongsTo('App\User');
    }

    /**
     * get package done 
     */
    public function package() {
        return $this->belongsTo('App\Package');
    }

    /**
     * get merged account
     */
    public function mergedAccount() {
        return $this->hasMany('App\MergeAccount');
    }
}
