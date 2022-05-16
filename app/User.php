<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','google_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['cart_items'];

    public function favorite()
    {
        return $this->belongsToMany(Book::class , 'favorites' , 'user_id' , 'book_id', 'id' , 'id');
    }

    public function cart()
    {
        return $this->belongsToMany(Book::class , 'cart' , 'user_id' , 'book_id', 'id' , 'id')->withPivot('quantity');
    }

    public function cart_items()
    {
        return $this->hasMany(Cart::class)->where('user_id' , auth()->user()->id);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
