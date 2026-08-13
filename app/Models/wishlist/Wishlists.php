<?php

namespace App\Models\wishlist;

use App\Models\customer\Customers;
use App\Models\product\Products;
use Illuminate\Database\Eloquent\Model;

class Wishlists extends Model
{

    protected $table = 'wishlists';
    protected $fillable = [
        'customer_id',
        'product_id'
    ];


    public function products() {
        return $this->belongsTo(Products::class,'product_id', 'id');
    }
}
