<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'user_id', 'totalPrice', 'method', 'status'];

    public function user ()
    {
        return $this->belongsTo('App\User');
    }

    public function orderItem ()
    { //order_id - foreign key
        return $this->hasMany('App\OrderItem');
    }
}
