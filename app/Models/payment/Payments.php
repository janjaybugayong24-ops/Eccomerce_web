<?php

namespace App\Models\payment;

use App\Models\order\Orders;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    public function order() {
        return $this->belongsTo(Orders::class);
    }
}
