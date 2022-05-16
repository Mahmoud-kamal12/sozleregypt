<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'cart';

    protected $appends = [ 'total'];

    protected $fillable = ['book_id','user_id','quantity'];

    public function user()
    {
        return $this->belongsTo(User::class)->withPivot('quantity');
    }

    public function getTotalAttribute(){
        $book = Book::where('id' , $this->book_id)->first();
        $total = $this->quantity * $book->price_le_after_discount;
        return $total;
    }
}
