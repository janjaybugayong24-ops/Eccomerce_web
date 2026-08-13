<?php

namespace App\Http\Helpers\ShippingHelper;

use App\Models\order\Orders;
use App\Models\shipping\Shipping;

class ShippingHelper
{
    private $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function createUpdate($id = null)
    {
        $shipping = Shipping::where('id', $id)->first();
        //  $status = $this->request->input('shipping_status');
        // $order_id = $shipping->order->id;
        $tracking_number = 'E-ship-' . rand(1111, 9999);


        Shipping::updateOrCreate(
            [
                'id'  => $id,
            ],
            [
                'order_id' =>  $this->request['order_id'],

                'tracking_number' => $tracking_number ?? $shipping->tracking_number,

                'courier' => $this->request['courier'],

                'shipping_status' => $this->request['shipping_status'] ?? $shipping->shipping_status,

                'shipped_at' => $this->request['shipped_at'] ?? $shipping->shipped_at,

            ]
        );
    }


    public function shipping_status($shipping_status)
    {
        if ($shipping_status == 1) {
            return 'Processing';
        } else if ($shipping_status == 2) {
            return 'Shipped';
        } else if ($shipping_status == 3) {
            return 'Cancelled';
        } else {
            return 'Pending';
        }
    }
}
