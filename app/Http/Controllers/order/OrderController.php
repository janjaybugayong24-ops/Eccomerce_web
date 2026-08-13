<?php

namespace App\Http\Controllers\order;

use App\Http\Controllers\Controller;
use App\Http\Helpers\OrderHelper\OrderHelper;
use App\Models\address\Addresses;
use App\Models\customer\Customers;
use App\Models\order\Orders;
use App\Models\orderitem\OrderItems;
use App\Models\product\Products;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class OrderController extends Controller
{
  
  private function order_helper($request) {
    return new OrderHelper($request);
  }
  
  public function admin_show_orders() {

    $orders = Orders::where('order_status', '0')->get(); 
       
    return view('Admin.orders.show_orders', compact('orders'));
  } 

   public function view_orders($id) {

    $orders = Orders::where('id', $id)->first();

    //$orders = Orders::findOrFail($id);

    //$address = Orders::where('address_id', $orders->address->id)->first();
 
    // $address = Addresses::where('customer_id', $orders->address->customer_id)->first();

    //dd($orders->address->customer_id);

    return view('Admin.orders.view_orders', compact('orders'));
   }

     public function update_status(Request $request, $id) {
        $orders = Orders::find($id);
        $orders->order_status = $request->input('order_status');
        $orders->update();

        return redirect(route('admin_show.orders'))->with('status', 'Order Status Updated Successfully');

     }

     public function order_history() {
           $orders = Orders::where('order_status','1')->get();
           return view('Admin/orders.order_history', compact('orders'));
     }
    
}

