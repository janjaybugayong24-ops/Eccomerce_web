<?php

namespace App\Models\order;

use App\Models\address\Addresses;
use App\Models\customer\Customers;
use App\Models\orderitem\OrderItems;
use App\Models\shipment\Shipments;
use App\Models\shipping\Shipping;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
   protected $table = 'orders';

    protected $fillable = [ 
     'customer_id',
     'address_id',
     'order_date',
     'order_status',
     'message',
     'tracking_number',
     'total_price'

     ];

     

     public function customer() {
        return $this->belongsTo(Customers::class);// many to one
     }

     public function address() {
         return $this->belongsTo(Addresses::class, 'address_id');// many to one
     }

     public function order_items() {
        return $this->hasMany(OrderItems::class, 'order_id'); // one to many
     }

      public function shipping() {
        return $this->hasOne(Shipping::class, 'order_id');
    }
}


