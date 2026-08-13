<?php

namespace App\Http\Controllers\wishlist;

use App\Http\Controllers\Controller;
use App\Models\product\Products;
use App\Models\wishlist\Wishlists;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index() {

        $wishlist = Wishlists::where('customer_id', Auth::user()->id)->get();
        return view('HomePage.products.wishlist', compact('wishlist'));
    }

    public function add_wishlist(Request $request) {

      if (Auth::check()) {

       $product_id = $request->input('product_id');
        if (Products::find($product_id)){
           $wishlist = new Wishlists();
           $wishlist->product_id = $product_id;
           $wishlist->customer_id = Auth::user()->id;
           $wishlist->save();

            return response()->json(['status'=> 'Product Added to Wishlist']);

        }else{
            return response()->json(['status' => 'Product does not exist.']);
        }
      }else{

        return response()->json(['status' => 'Login to Continue']);

      }
    }


    public function delete_wishlist_item(Request $request) {
    if (Auth::check()) 
     {
          $product_id = $request->input('product_id');
      if (Wishlists::where('product_id', $product_id)->where('customer_id', Auth::user()->id)->exists())
          {
               $wishlist_item = Wishlists::where('product_id', $product_id)->where('customer_id', Auth::user()->id)->first();
               $wishlist_item->delete();
                return response()->json(['status' => 'Product Deleted Successfully']);
          }
       }else{
            return response()->json(['status' => 'Please, Log in to Continue']);
         }
 }

    public function wishlist_count() {
       $wishlist_count = Wishlists::where('customer_id', Auth::user()->id)->count();

       return response()->json(['count' => $wishlist_count]);
    }
   
} 
