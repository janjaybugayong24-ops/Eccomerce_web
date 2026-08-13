<?php

namespace App\Models\cart;

use App\Models\cartitem\CartItems;
use App\Models\product\Products;
use Illuminate\Database\Eloquent\Model;

class Carts extends Model
{
    protected $table = 'carts';
    
    protected $fillable = [
         'customer_id',
         'product_id',
         'product_quantity'
    ];
 
    public function cartitems() {
        return $this->hasMany(CartItems::class);
    }

    public function products() {
        return $this->belongsTo(Products::class, 'product_id', 'id');   
    }

}
