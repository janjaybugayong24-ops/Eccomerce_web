<?php

namespace App\Models\inventorylog;

use App\Models\product\Products;
use Illuminate\Database\Eloquent\Model;

class Inventorylogs extends Model
{
    public function product() {
        return $this->belongsTo(Products::class);
    }
}
