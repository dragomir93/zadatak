<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = 'users_checkout';
    protected $guarded = array();
    public $timestamps = false;
}
