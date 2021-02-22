<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersCheckout extends Model
{   
    protected $primaryKey = 'id';
    protected $table = 'users_checkout';
    protected $guarded = array();
    public $timestamps = false;
}
