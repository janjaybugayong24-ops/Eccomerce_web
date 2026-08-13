<?php

namespace App\Models\brand;


use App\Models\product\Products;
use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{

protected $table = 'brands';

protected $fillable = [
 'brand_name',
  'slug',
  'logo',
  'status',
 'description'
];

    public function product() {
        return $this->hasMany(Products::class);
    }
}



