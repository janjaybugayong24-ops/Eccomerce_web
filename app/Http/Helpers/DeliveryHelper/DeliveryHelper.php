<?php

namespace App\Http\Helpers\DeliveryHelper;

use App\Models\deliveries\Delivery;
use App\Models\order\Orders;
use App\Models\shipping\Shipping;

class DeliveryHelper
{
    private $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function createUpdate($id = null)
    {
        $delivery = Delivery::where('id', $id)->first();

        Delivery::updateOrCreate(
            [
                'id'  => $id,
            ],

            [
                'shipping_id' =>  $this->request['shipping_id'],

                'expected_delivery_date' => $this->request['expected_delivery_date'],

                'delivery_status' => $this->request['delivery_status'],

                'delivered_at' => $this->request['delivered_at']
            ]
        );
    }

    public function delivery_status($delivery_status)
    {
        if ($delivery_status == 1) {
            return 'Out for Delivery';
        } else if ($delivery_status == 2) {
            return 'Delivered';
        } else if ($delivery_status == 3) {
            return 'Failed';
        } else {
            return 'Pending';
        }
    }
}
