<?php

namespace App\Models\shipment;

use App\Models\order\Orders;
use Illuminate\Database\Eloquent\Model;

class Shipments extends Model
{
    public function order() {
        return $this->belongsTo(Orders::class);
    }
}
