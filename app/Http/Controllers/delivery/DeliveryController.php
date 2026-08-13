<?php

namespace App\Http\Controllers\delivery;

use App\Http\Controllers\Controller;
use App\Models\deliveries\Delivery;
use App\Models\shipping\Shipping;
use Illuminate\Http\Request;
use App\Http\Helpers\DeliveryHelper\DeliveryHelper;

class DeliveryController extends Controller
{
    private function delivery_helper($request)
    {
        return new DeliveryHelper($request);
    }

    public function create_delivery($shipping_id)
    {
        $check_shipping = Shipping::where('id', $shipping_id)->exists();

        if ($check_shipping) {

            $deliveries = Delivery::where('shipping_id', $shipping_id)->first();

            $shipping = Shipping::where('id', $shipping_id)->first();

            return view('Admin.delivery.create_deliveries', compact('deliveries', 'shipping'));
        } else {
            return redirect()->back()->with('status', 'Shipping must exists before managing deliveries.');
        }
    }

    public function store_delivery(Request $request)
    {
        $shipping_id = $request->input('shipping_id');

        $check_shipping_status = Shipping::where('id', $shipping_id)->where('shipping_status', 2)->exists();

        if ($check_shipping_status) {

            $shipping = Shipping::where('id', $shipping_id)->where('shipping_status', 2)->first();

            $validate = $request->validate([
                'expected_delivery_date' => 'required|date',
                'delivery_status' => 'required|in:0,1,2,3',
                'delivered_at' => 'nullable|date',
                'shipping_id' => 'required',
            ]);

            $deliveryHelper = $this->delivery_helper($validate);

            $deliveryHelper->createUpdate();

            return redirect()->route('get.shipping', $shipping->order_id)->with('status', 'Order Shipped Created.');
        } else {

            return redirect()->back()->with('status', 'shipping must be shipped before accessing deliveries section.');
        }
    }

    public function view_delivery($shipping_id)
    {

        $check_shipping_id = Delivery::where('shipping_id', $shipping_id)->exists();

        if ($check_shipping_id) {

            $delivery = Delivery::where('shipping_id', $shipping_id)->first();

            return view('Admin.delivery.view_delivery', compact('delivery'));
        } else {
            return redirect()->back()->with('status', 'Delivery details does not exist.');
        }
    }

    public function edit_deliveries($delivery_id)
    {

        $check_delivery = Delivery::where('id', $delivery_id)->exists();

        if ($check_delivery) {

            $delivery = Delivery::where('id', $delivery_id)->first();

            return view('Admin.delivery.edit_delivery', compact('delivery'));
        } else {
            return redirect()->back()->with('status', 'Delivery Id does not exist at all.');
        }
    }

    public function update_deliveries(Request $request, $delivery_id)
    {
        $validate = $request->validate([
            'expected_delivery_date' => 'required|date',
            'delivery_status' => 'required|in:0,1,2,3',
            'delivered_at' => 'nullable|date',
            'shipping_id' => 'required'
        ]);

        $shipping_id = $request->input('shipping_id');
        $data = Delivery::where('id', $delivery_id)->first();

        $deliveryHelper = $this->delivery_helper($validate);

        $deliveryHelper->createUpdate($delivery_id);

        return redirect()->route('view.delivery', $shipping_id)->with('status', 'Delivery details updated successfuly');
    }
}
