<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'cart';
    protected $primary_key = 'id_cart';
    protected $guarded = array();
    public $timestamps = false;
}
