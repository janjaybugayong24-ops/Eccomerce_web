<?php

namespace App\Http\Controllers\rating;

use App\Http\Controllers\Controller;
use App\Models\order\Orders;
use App\Models\product\Products;
use App\Models\rating\Ratings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function product_rating(Request $request) {

     $rate = $request->input('product_rating');

     $product_id = $request->input('product_id');

     $product_check = Products::where('id', $product_id)->where('status', '0')->first();
     
     if ($product_check) {
        $verified_purchase = Orders::where('orders.customer_id', Auth::user()->id)
        ->join('order_items', 'orders.id', 'order_items.order_id')
        ->where('order_items.product_id', $product_id)->get();

        if ($verified_purchase->count() > 0) {

            $rating_existed = Ratings::where('customer_id', Auth::user()->id)->where('product_id', $product_id)->first();

         if($rating_existed) {
            
              $rating_existed->rated_star = $rate;
              $rating_existed->update();

              return redirect()->back()->with('status', 'Rating updated!');

         }else{

           Ratings::create([
               'customer_id' => Auth::user()->id,
               'product_id' => $product_id,
               'rated_star' => $rate
             ]);

             return redirect()->back()->with('status', 'Thank you for rating this product!');

         }
        }else{
            return redirect()->back()->with('status', 'You cannot rate a product without purchasing it.');
        }
     }else{
          return redirect()->back()->with('status', 'The link you followed was broken');
    }

    }
}
