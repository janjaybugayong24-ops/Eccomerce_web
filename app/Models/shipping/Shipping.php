<?php

namespace App\Models\shipping;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $table = 'Shipping';

    protected $fillable = [
        'order_id',
        'courier',
        'tracking_number',
        'shipping_status',
        'shipped_at'
    ];

    public function order()
    {
        return $this->hasOne(Shipping::class, 'order_id');
    }
}
