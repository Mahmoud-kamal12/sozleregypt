<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'paymob_order_id','paymob_order_status' , 'paymob_transaction_id', 'amount_cents' ,'email',  'firstname' , 'lastname' , 'phone' , 'city' , 'country' ,'address','zip'];

    protected $appends = ['full_name' , 'amount'];

    public function user()
    {
        return $this->belongsToMany(User::class , 'users' );
    }

    public function items()
    {
        return $this->hasMany(OrderItems::class );
    }

    public function getFullNameAttribute(){
            return implode(  ' ', [$this->firstname , $this->lastname]);
    }

    public function getAmountAttribute(){
        return $this->amount_cents / 100;
    }

}
