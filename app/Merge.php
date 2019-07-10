<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Merge extends Model
{
    //create fillable
    protected $fillable = ['userPackageId','mergedTo','proofOfPayment',
        'startDate','confirmed'
    ];

    /**
     * get account
     */
    public function account() {
        return $this->belongsTo('App\UserPackage','userPackageId');
    }

    /**
     * get merged account
     */
    public function mergedAccount() {
        return $this->belongsTo('App\UserPackage','mergedTo');
    }
}
