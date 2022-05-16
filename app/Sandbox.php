<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sandbox extends Model
{
    protected $fillable = [
        'name', 'email', 'message',
    ];
}
