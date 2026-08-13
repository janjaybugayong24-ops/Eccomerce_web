<?php

namespace App\Http\Controllers\review;

use App\Http\Controllers\Controller;
use App\Models\category\Categories;
use App\Models\order\Orders;
use App\Models\product\Products;
use App\Models\review\Reviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function customer_review_product($prod_slug) {
       
    $product = Products::where('slug', $prod_slug)->where('status', '0')->first();
       
        if ($product) {
           $product_id = $product->id;
           
        $review_check = Reviews::where('customer_id', Auth::user()->id)->where('product_id', $product_id)->first();

        if($review_check) {

             return redirect()->back()->with('status', 'You cannot write a review again.');
        
             }else{
             $verified_purchase = Orders::where('orders.customer_id', Auth::user()->id)
                ->join('order_items', 'orders.id', 'order_items.order_id')
                ->where('order_items.product_id', $product_id)->get();
            return view('HomePage.reviews.index', compact('product', 'verified_purchase'));
        }

       
        }else{
            return redirect()->back()->with('status', 'The link you followed was broken');
        }
    }

    public function add_review(Request $request) {

     $product_id = $request->input('product_id');

     $product = Products::where('id', $product_id)->where('status', '0')->first();

     if ($product) {
         
        $customer_review = $request->input('customer_review');

        $new_review = Reviews::create([
          'customer_id' => Auth::user()->id,
          'product_id' => $product_id,
           'customer_review' => $customer_review
        ]);
       
        $category_slug = $product->category->slug;
        $prod_slug = $product->slug;

        if($new_review) {
          return redirect(url('category/'.$category_slug.'/'.$prod_slug))->with('status', 'Thank you for writing a review for our product!');
        }

     }else{

         return redirect()->back()->with('status', 'The link you followed was broken');
     }

    }


    public function edit_review($slug) 
     {
      $product = Products::where('slug', $slug)->where('status', '0')->first();

      if ($product) {
       $product_id = $product->id;
       $review = Reviews::where('customer_id', Auth::user()->id)->where('product_id', $product_id)->first();

       if ($review) {
          return view('HomePage.reviews.edit_review', compact('review', 'product'));

       }else{
          return redirect()->back()->with('status', 'The link you followed is broken');
       }

      }else{
            return redirect()->back()->with('status', 'The link you followed is broken');
      }

    }

    public function edit(Request $request, $slug) {

    $new_review = $request->input('edit_customer_review');

    $product = Products::where('slug', $slug)->where('status', '0')->first();

    if ($product) {

    $review = Reviews::where('customer_id', Auth::user()->id)->where('product_id', $product->id)->first();
    
    if ($review != '') {

       $review->customer_review = $new_review;

       $review->update();

       $category_slug = $product->category->slug;
       $prod_slug = $product->slug;

        return redirect(url('category/'.$category_slug.'/'.$prod_slug))->with('status', 'Review updated successfully');
    
        }else{
           return redirect()->back()->with('status', 'You cannot update review, when empty.'); 
    }

    }else{
          return redirect()->back()->with('status', 'The link you followed is broken');
    }

    }
}
