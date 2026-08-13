<?php
namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\category\Categories;
use App\Models\product\Products;
use App\Models\rating\Ratings;
use App\Models\review\Reviews;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller{

    public function slider() {
     
      $featured_product = Products::where('trending', '1')->take(15)->get();

      $popular_categories = Categories::where('popular', '1')->take(15)->get();

       return view('HomePage.homepage', compact('featured_product', 'popular_categories'));
    }



    public function category() {

       $category = Categories::where('status', '0')->get();

        return view('HomePage.category', compact('category'));
    }

    public function view_category($slug) {

       if (Categories::where('slug',$slug)->exists()) {

          $category = Categories::where('slug', $slug)->first();

          $products = Products::where('category_id', $category->id)->where('status', '0')->get();
          
          return view('HomePage.products.index', compact('category', 'products'));

       }else{

       return redirect('/')->with('status', 'Slug does not exist.');
       }
    }

    public function product_view($category_slug, $product_slug) {

         if (Categories::where('slug', $category_slug)->exists()) {

            if (Products::where('slug', $product_slug)->exists()) {
                 $products = Products::where('slug', $product_slug)->first();
                 $rating = Ratings::where('product_id', $products->id)->get();
                 $ratings_sum = Ratings::where('product_id', $products->id)->sum('rated_star');
                 $customer_rating = Ratings::where('product_id', $products->id)->where('customer_id', Auth::user()->id)->first();
                 $reviews = Reviews::where('product_id', $products->id)->get();
                 if ($rating->count() > 0) {

                    $rating_value = $ratings_sum / $rating->count();

                 }else{
                      $rating_value = 0;
                 }
                  return view('HomePage.products.view', compact('products', 'rating', 'rating_value', 'customer_rating', 'reviews'));
         }else{
              return redirect('/')->with('status', 'The link was broken');
        }
         }else{
              return redirect('/')->with('status', 'No such category found');
        }
    }

    public function productList_ajax() {

       $products = Products::select('product_name')->where('status', '0')->get(); 
       $data = [];

       foreach($products as $prod_item) {
           $data[] = $prod_item['product_name'];
       }
        return $data;
    }

    public function search_product(Request $request) 
    {
       $search_product = $request->product_name;

       if ($search_product != '') {

          $product = Products::where('product_name', 'LIKE', "%$search_product%")->first();
             //'category/{category_slug}/{product_slug}
          if($product) {
              return redirect('category/'.$product->category->slug.'/'.$product->slug);
          }else{
            return redirect()->back()->with('status', 'Product does not exist.');
          }
       }else{
         return redirect()->back();
       }

    }
}

?>