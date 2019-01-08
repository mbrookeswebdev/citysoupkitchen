<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['id', 'imagePath', 'title', 'description', 'price'];

    public function orderItem ()
    {
        return $this->hasMany('App\OrderItem', 'product_id');
    }
}
