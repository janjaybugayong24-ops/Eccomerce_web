<?php

namespace App\Http\Controllers\cart;

use App\Http\Controllers\Controller;
use App\Models\cart\Carts;
use App\Models\product\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add_product(Request $request) 
    {
         $product_id = $request->input('product_id');
         $product_quantity = $request->input('product_quantity');
         
         if(Auth::check()) {
            $product_check = Products::where('id', $product_id)->first();

            if ($product_check) {

            if(Carts::where('product_id', $product_id)->where('customer_id', Auth::user()->id)->exists()){
                  return response()->json(['status' => $product_check->product_name.' is Already Added to Cart']);
            }else{
                $cart_item = new Carts();
                $cart_item->product_id = $product_id;
                $cart_item->customer_id = Auth::user()->id;
                $cart_item->product_quantity = $product_quantity;
                $cart_item->save();

                 return response()->json(['status' => $product_check->product_name.' Added to Cart Succesfully ']);
            }            
            }

         }else{
           return response()->json(['status' => 'Log in to Continue']);
         }
    }


    public function view_cart() {

       $cart_items = Carts::where('customer_id', Auth::user()->id)->get();

        return view('HomePage.cart', compact('cart_items'));
 }

   public function update_cart(Request $request) {

      $product_id = $request->input('product_id');
      $product_quantity = $request->input('product_quantity');
      
      if(Auth::check()) {
           if (Carts::where('product_id', $product_id)->where('customer_id', Auth::user()->id)->exists())
          { 
               $cart = Carts::where('product_id', $product_id)->where('customer_id', Auth::user()->id)->first();

               $cart->product_quantity = $product_quantity;

               $cart->update();
               return response()->json(['status' => 'Quantity updated']);
          }
      }

 }

 public function delete_cart_item(Request $request) {
    if (Auth::check()) 
     {
          $product_id = $request->input('product_id');
      if (Carts::where('product_id', $product_id)->where('customer_id', Auth::user()->id)->exists())
          {
               $cart_item = Carts::where('product_id', $product_id)->where('customer_id', Auth::user()->id)->first();
               $cart_item->delete();
               
                return response()->json(['status' => 'Product Deleted Successfully']);
          }
       }else{
            return response()->json(['status' => 'Please, Log in to Continue']);
         }
 }


   public function cart_count() {

       $cart_count = Carts::where('customer_id', Auth::user()->id)->count();

       return response()->json(['count' => $cart_count]);
   }
 

}





