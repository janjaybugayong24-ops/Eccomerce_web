<?php

namespace App\Models\cartitem;

use App\Models\cart\Carts;
use App\Models\product\Products;
use Illuminate\Database\Eloquent\Model;

class CartItems extends Model
{
    public function cart() {
        return $this->belongsTo(Carts::class);
    }

    public function product() {
        return $this->belongsTo(Products::class);
    }

}
