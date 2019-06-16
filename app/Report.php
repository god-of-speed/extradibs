<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    //create fillable
    protected $fillable = ['userId','report'];

    /**
     * get user
     *
     */
    public function user() {
        return $this->belongsTo('App\User');
    }
}
