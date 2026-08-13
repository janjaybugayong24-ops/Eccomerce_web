<?php

namespace App\Models\address;

use App\Models\customer\Customers;
use App\Models\order\Orders;
use Illuminate\Database\Eloquent\Model;

class Addresses extends Model
{

    protected $table = "address";

    protected $fillable = [
     'customer_id',
     'FullName',
     'email',
     'phone_number',
     'main_address',
     'city',
     'province',
     'postal_code',
    ];
    
    public function customer() {
        return $this->belongsTo(Customers::class, 'customer_id', 'id');// many to one
    }
}
