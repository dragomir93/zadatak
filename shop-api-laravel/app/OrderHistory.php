<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model
{
    protected $table = 'order_history';
    protected $primary_key = 'email';
    protected $guarded = array();
    public $timestamps = false;
}
