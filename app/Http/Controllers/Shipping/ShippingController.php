<?php

namespace App\Http\Controllers\Shipping;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ShippingHelper\ShippingHelper;
use App\Models\customer\Customers;
use App\Models\order\Orders;
use App\Models\shipping\Shipping;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
   private function shipping_helper($request)
   {

      return new ShippingHelper($request);
   }
   public function view_shipments($order_id)
   {

      $check_order = Orders::where('id', $order_id)->first();

      return view('Admin.shipping.create_shipping', compact('check_order'));
   }

   public function create_shipments(Request $request)
   {

      $validate = $request->validate([
         'courier' => 'nullable|string|max:20',
         'shipping_status' => 'required|in:0,1,2,3,4',
         'shipped_at' => 'required|date',
         'order_id' => 'required'
      ]);

      $order_id = $request->input('order_id');

      $shippingHelper = $this->shipping_helper($validate);

      $shippingHelper->createUpdate();

      return redirect()->route('get.shipping', $order_id)->with('status', 'Order Shipped Created.');
   }

   public function edit_shipping($shipping_id)
   {

      $shippingData = Shipping::where('id', $shipping_id)->exists();

      if ($shippingData) {

         $shipping_data = Shipping::where('id', $shipping_id)->first();

         return view('Admin.shipping.edit_shipping', compact('shipping_data'));
      } else {

         return redirect()->route('admin_show.orders')->with('status', 'Shipping Id not exist');
      }
   }

   public function update_shipping(Request $request, $shipping_id)
   {
      $validate = $request->validate([
         'courier' => 'nullable|string|max:20',
         'shipping_status' => 'required|in:0,1,2,3,4',
         'shipped_at' => 'nullable|date',
         'order_id' => 'required'
      ]);
      
      $order_id = $request->input('order_id');

      $data = Shipping::where('id', $shipping_id)->first();

      $shippingHelper = $this->shipping_helper($validate);

      $shippingHelper->createUpdate($shipping_id);

      return redirect()->route('get.shipping', $data->order_id)->with('status', 'Shipping details updated successfuly');
   }


   public function show_shipping($order_id)
   {

      $shipping_data = Shipping::where('order_id', $order_id)->first();

      if ($shipping_data) {
         return view('Admin.shipping.show_shipping', compact('shipping_data'));
      } else {
         return redirect(url('admins/view/order/' . $order_id))->with('status', 'Shipping does not exist');
      }
   }   


}
