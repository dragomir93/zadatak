<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $primaryKey = 'id_cart';
    protected $table = 'cart';
    protected $guarded = array();
    public $timestamps = false;
}
