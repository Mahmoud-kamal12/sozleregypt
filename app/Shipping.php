<?php

namespace App;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use Translatable;

    public $translatedAttributes = ['city'];
    protected  $fillable = ['city' , 'cost' ];
}
