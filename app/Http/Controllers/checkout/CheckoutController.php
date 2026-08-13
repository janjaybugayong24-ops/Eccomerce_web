<?php

namespace App\Http\Controllers\checkout;

use App\Http\Controllers\Controller;
use App\Models\address\Addresses;
use App\Models\cart\Carts;
use App\Models\customer\Customers;
use App\Models\order\Orders;
use App\Models\orderitem\OrderItems;
use App\Models\product\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Http;
use App\Http\Helpers\CheckoutHelper\CheckoutHelper;

use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    private function checkout_helper()
    {

        return new CheckoutHelper();
    }


    public function index()
    {

        $old_cartitems = Carts::where('customer_id', Auth::user()->id)->get();

        foreach ($old_cartitems as $old_items) {

            if (!Products::where('id', $old_items->product_id)->where('stock_quantity', '>=', $old_items->product_quantity)->exists()) {
                $remove_item = Carts::where('customer_id', Auth::user()->id)->where('product_id', $old_items->product_id)->first();
                $remove_item->delete();
            }
        }
        $cart_items = Carts::where('customer_id', Auth::user()->id)->get();
        $address = Addresses::where('customer_id', Auth::user()->id)->first();
        return view('HomePage.products.checkout', compact('cart_items', 'address'));
    }

    public function place_order(Request $request)
    {

        $validate = $request->validate([
            'message' => 'string|nullable',
        ]);

        $address = Addresses::where('customer_id', Auth::user()->id)->first();

        $order = new Orders();

        $order->customer_id = Auth::user()->id;
        $order->address_id = $address->id;
        $order->tracking_number = 'E-Shopping-' . rand(1111, 9999);
        $order->order_date = now();
        $order->message = $validate['message'];

        $total = 0;
        $cart_items_total = Carts::where('customer_id', Auth::user()->id)->get();

        foreach ($cart_items_total as $product_total) {

            $total += $product_total->products->selling_price * $product_total->product_quantity;
        }

        $order->total_price = $total;

        $order->save();

        $cart_items = Carts::where('customer_id', Auth::user()->id)->get();

        foreach ($cart_items as $cartItem) {
            OrderItems::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->product_quantity,
                'price' => $cartItem->products->selling_price
            ]);

            $prod = Products::where('id', $cartItem->product_id)->first();
            $prod->stock_quantity -= $cartItem->product_quantity;
            $prod->update();
        }

        return redirect(route('view.order', $order->id))->with('status', 'Order Placed Successfully');
    }

    public function pay()
    {

        $checkout_helper = $this->checkout_helper();

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'accept' => 'application/json',
            'Authorization' => 'Basic ' . env('AUTH_PAY')

        ])->post(
            'https://api.paymongo.com/v1/checkout_sessions',
            $checkout_helper->checkout_data()
        );

        // dd($response->json());

        Session::put('session_id', $response['data']['id']);

        return redirect()->to($response['data']['attributes']['checkout_url']);
    }

    public function success()
    {

        $session_id = Session::get('session_id');

        $response = Http::withHeaders([
            'accept' => 'application/json',
            'Authorization' => 'Basic ' . env('AUTH_PAY')

        ])->get('https://api.paymongo.com/v1/checkout_sessions/' . $session_id);

        dd($response->json());
    }

    public function link_pay()
    {

        $data = $this->checkout_helper();

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'accept' => 'application/json',
            'Authorization' => 'Basic ' . env('AUTH_PAY')

        ])->post(
            'https://api.paymongo.com/v1/links',

            $data->data_pay()
        );


        dd($response->json());
    }

    public function link_status($linkid)
    {
        $response = Http::withHeaders([
            'accept' => 'application/json',
            'Authorization' => 'Basic ' . env('AUTH_PAY')

        ])->get(
            'https://api.paymongo.com/v1/links/' . $linkid,
        );

        dd($response->json());
    }
}   



    /*
  /*  $data = [
                        'data' =>[
                           'attributes' => [
                               'line_items' =>[
                                 [
                                'currency' => 'PHP',
                                'amount' => 10000,
                                'description' => 'text',
                                'name' => 'Test Product',
                                'quantity' => 1,  
                              ]
                               ], 
                           'payment_method_types' => ['card'],
                           'success_url' => 'http://127.0.0.1:8000',
                           'cancel_url' => 'http://127.0.0.1:8000',
                           'description' => 'text',
                           ], 
                        ]
                    ];

              $response = Curl::to('https://api.paymongo.com/v1/checkout_sessions')
                             ->withHeader('Content-Type: application/json')
                             ->withHeader('accept: application/json')
                             ->withHeader('Authorization: Basic '.env('AUTH_PAY'))
                             ->withData($data)
                             ->asJson()
                             ->post();
                
                 dd($response);
                */

                 /*
                 {
    "data": {
        "id": "cs_363478981f10d39b82016723",
        "type": "checkout_session",
        "attributes": {
            "billing": {
                "address": {
                    "city": null,
                    "country": null,
                    "line1": null,
                    "line2": null,
                    "postal_code": null,
                    "state": null
                },
                "email": null,
                "name": null,
                "phone": null
            },
            "billing_information_fields_editable": "enabled",
            "cancel_url": "https://example.com/cancel",
            "checkout_url": "https://checkout.paymongo.com/363478981f10d39b82016723",
            "client_key": "cs_363478981f10d39b82016723_client_455132a4fef934ee97ae1b44",
            "collection": {
                "customer_info": {
                    "email": {
                        "state": "auto"
                    },
                    "name": {
                        "state": "auto"
                    },
                    "mobile_phone": {
                        "state": "auto"
                    },
                    "address": {
                        "state": "auto"
                    }
                }
            },
            "customer_email": null,
            "customer_id": null,
            "description": null,
            "line_items": [
                {
                    "amount": 50000,
                    "currency": "PHP",
                    "description": "I am using post!!",
                    "images": [],
                    "name": "Testing lang sir...",
                    "quantity": 2
                }
            ],
            "livemode": false,
            "merchant": "JANJAY MENESES BUGAYONG",
            "metadata": null,
            "organization_id": "org_4JayknMMA8vMazRJLds2GMtB",
            "pass_on_fees": false,
            "payment_intent": {
                "id": "pi_nxJzRDacULNokTv3AL6nFXEH",
                "type": "payment_intent",
                "attributes": {
                    "amount": 100000,
                    "capture_type": "automatic",
                    "client_key": "pi_nxJzRDacULNokTv3AL6nFXEH_client_rnvzZsEqpHBMEk9AAuXY7Ei8",
                    "currency": "PHP",
                    "description": null,
                    "last_payment_error": null,
                    "livemode": false,
                    "metadata": null,
                    "next_action": null,
                    "original_amount": 100000,
                    "payment_method_allowed": [
                        "card"
                    ],
                    "payment_method_options": {
                        "card": {
                            "request_three_d_secure": "any"
                        }
                    },
                    "payments": [],
                    "setup_future_usage": null,
                    "statement_descriptor": "JANJAY MENESES BUGAYONG",
                    "status": "awaiting_payment_method",
                    "created_at": 1779384852,
                    "updated_at": 1779384852
                }
            },
            "payment_method_types": [
                "card"
            ],
            "payments": [],
            "public_key": "pk_test_jy663GsogJToeJVLGqUgKdPW",
            "reference_number": null,
            "send_email_receipt": false,
            "show_description": true,
            "show_line_items": true,
            "status": "active",
            "success_url": "https://example.com/success",
            "created_at": 1779384852,
            "updated_at": 1779384852
        }
    }
}
    */
