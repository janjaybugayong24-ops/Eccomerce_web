<?php

namespace App\Models\product;

use App\Models\address\Addresses;
use App\Models\brand\Brands;
use App\Models\category\Categories;
use App\Models\inventorylog\Inventorylogs;
use App\Models\orderitem\OrderItems;
use App\Models\review\Reviews;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Products extends Model
{
    use HasFactory;
   protected $table = "products";
   
    protected $fillable = [
    'product_name',
    'category_id',
    'brand_id',
    'product_photo',
    'description',
    'stock_quantity',
    'price',
    'selling_price',
    'status',
    'trending',
    'meta_title',
    'meta_keywords',
    'meta_description'
    ];

    public function orderItems() {
        return $this->hasMany(OrderItems::class);
    }

    public function review() {
        return $this->hasMany(Reviews::class); 
    }
    public function inventorylog() {
        return $this->hasMany(Inventorylogs::class); 
    }

    public function category() {

        return $this->belongsTo(Categories::class, 'category_id', 'id');
    }

     public function brand() {
        
        return $this->belongsTo(Brands::class, 'brand_id', 'id');
    }

    public function address() {
        return $this->belongsTo(Addresses::class, '');
    }
}

