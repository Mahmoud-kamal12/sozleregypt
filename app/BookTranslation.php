<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class BookTranslation extends Model
{

    public $timestamps = false;
    protected $fillable = [
        'name' ,
        'binding_type' ,
        'paper_type',
        'printing_colors',
        'about'
    ];
}
