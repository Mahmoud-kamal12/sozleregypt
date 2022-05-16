<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    protected $fillable = ['book_id','name','quantity','amount_cents' , 'order_id'];

    public function order()
    {
        return $this->belongsTo(Order::class , 'orders' )->withPivot('name','quantity','amount_cents');
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
