<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['id', 'order_id', 'product_id', 'productQuantity'];

    public function order ()
    {
        return $this->belongsTo('App\Order');
    }

    public function product ()
    {
        return $this->belongsTo('App\Product');
    }
}
