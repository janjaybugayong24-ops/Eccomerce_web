<?php

namespace App\Models\category;

use App\Models\product\Products;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'categories';

   protected  $fillable = [
      'category_name',
      'slug',
      'description',
      'category_photo',
      'status',
      'popular',
      'meta_title',
      'meta_description',
      'meta_keywords'
   ];

    public function product() {
      return $this->hasMany(Products::class);
    }
}
