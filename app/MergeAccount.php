<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MergeAccount extends Model
{
    //create fillable
    protected $fillable = ['name','number','startDate'];
}
