<?php

namespace App\Models\orderitem;

use App\Models\order\Orders;
use App\Models\product\Products;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    protected $table = 'order_items';

    protected $fillable = [
      'order_id',
      'product_id',
      'quantity',
      'price'
    ];

    public function order() {
        return $this->belongsTo(Orders::class);
    }

    public function products() {
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }
   
    
}
