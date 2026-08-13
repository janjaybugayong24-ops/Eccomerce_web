<?php

namespace App\Models\deliveries;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $table = 'delivery';

    protected $fillable = [
        'shipping_id',
        'expected_delivery_date',
        'delivered_at',
        'delivery_status'
    ];
}
