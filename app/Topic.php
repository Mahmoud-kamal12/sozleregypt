<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;



class Topic extends Model implements TranslatableContract
{

    use Translatable;

    public $translatedAttributes = ['topic'];
    protected  $fillable = ['topic' ];
}
