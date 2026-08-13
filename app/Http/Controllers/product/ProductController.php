<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ProductHelper\ProductHelper;
use App\Models\brand\Brands;
use App\Models\category\Categories;
use App\Models\product\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProductController extends Controller{

    private function product_helper($request){
    return new ProductHelper($request);
    }

    public function index() {

     $display_data = Products::all();  
   
    return view('products.index', ['products' => $display_data]);
    }

    
    public function create() {
   
        $category = Categories::all();
        $brand = Brands::all();

        return view('products.create', compact('category', 'brand'));
    }


    public function store(Request $request) {

     $validate = $request->validate([
     'product_name' => 'required|string|max:100',
     'slug' => 'required|string',
     'category_id' => 'required',
     'brand_id' => 'required',
     'product_photo' => 'required|image|mimes:jpeg,jpg,png,gif',
     'description' => 'required|string|max:150',
     'stock_quantity' => 'required|numeric|min:1|max:100',
     'price' => 'required|numeric',
     'selling_price' => 'required|numeric',
     'status' => 'nullable',
     'trending' => 'nullable',
     'meta_title' => 'required',
     'meta_description' => 'required|string|max:150',
     'meta_keywords' => 'required|string|max:150'

     ]);

       $product = new Products();

       $product->product_name = $validate['product_name'];
       $product->slug = $validate['slug'];
       $product->category_id = $validate['category_id'];
       $product->brand_id = $validate['brand_id'];
       $product->description = $validate['description'];
       $product->stock_quantity = $validate['stock_quantity'];
       $product->price = $validate['price'];
       $product->selling_price = $validate['selling_price'];
       $product->status = $request->has('status') ? 1 : 0;
       $product->trending = $request->has('trending') ? 1 : 0;
       $product->meta_title = $validate['meta_title'];
       $product->meta_description = $validate['meta_description'];
       $product->meta_keywords = $validate['meta_keywords'];

        if ($request->hasFile('product_photo')){

        $file = $request->file('product_photo');
        $extention = $file->getClientOriginalExtension();
        $filename = time().'.'.$extention;
        $file->move('public/customer/', $filename);

        $product->product_photo = $filename;
          
    }
        $product->save();

        return redirect(route('product.index'));

      }


    public function edit($id) {

      $product = Products::findOrFail($id);
      $category = Categories::all();
      $brand = Brands::all();

      return view('products.edit', compact('product', 'category', 'brand'));

    }
    

    public function update(Request $request,  $id) {
    $validate = $request->validate([
     'product_name' => 'required|string|max:100',
     'slug' => 'required|string',
     'description' => 'required|string|max:150',
     'stock_quantity' => 'required|numeric|min:0|max:100',
     'product_photo' => 'image|mimes:jpeg,jpg,png,gif',
     'price' => 'required|numeric',
     'selling_price' => 'required|numeric',
     'status' => 'nullable',
     'trending' => 'nullable',
     'meta_title' => 'required',
     'meta_description' => 'required|string|max:150',
     'meta_keywords' => 'required|string|max:150'
     ]);
        $product = Products::find($id);

      if ($request->hasFile('product_photo')){
        
        $destination = 'public/customer/'.$product->product_photo;

        if (File::exists($destination)) {

             File::delete($destination);
        }
        $file = $request->file('product_photo');
        $extention = $file->getClientOriginalExtension();
        $filename = time().'.'.$extention;
        $file->move('public/customer/', $filename);

        $product->product_photo = $filename;
          
    }
      
       $product->save();

       $product_helper = $this->product_helper($validate);

       $product_helper->productData($id);

        return redirect(route('product.index'));
    }

    

    public function destroy(Products $id) {
        $id->delete();
        return redirect(route('product.index'));
    }
}

