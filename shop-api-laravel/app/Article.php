<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['title', 'description', 'image','price'];
    protected $table = 'articles';
    protected $primaryKey = 'id';
    protected $guarded = array();
    public $timestamps = false;
}
