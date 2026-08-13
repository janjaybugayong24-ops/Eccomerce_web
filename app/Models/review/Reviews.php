<?php

namespace App\Models\review;

use App\Models\customer\Customers;
use App\Models\product\Products;
use App\Models\rating\Ratings;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{

 protected $table = 'reviews';
 protected $fillable = [
    'customer_id',
    'product_id',
    'customer_review'
    ];
    public function customer() {
        return $this->belongsTo(Customers::class);
    }

    public function rating() {
        return $this->belongsTo(Ratings::class, 'customer_id', 'id');
    }

    public function product() {
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }
}
