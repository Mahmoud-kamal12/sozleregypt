<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CharacterTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];
}
