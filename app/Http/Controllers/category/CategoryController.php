<?php

namespace App\Http\Controllers\category;

use App\Http\Controllers\Controller;
use App\Http\Helpers\CategoryHelper\CategoryHelper;
use App\Models\category\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    private function category_helper($request){
       return new CategoryHelper($request);
    }


    public function create() {
        return view('categories.create');
    }

    public function store(Request $request) {

     $validate = $request->validate([
        'category_name' => 'required|string|unique:categories|max:20',
        'slug' => 'required|string|max:150',
        'description' => 'required|string|max:150',
        'category_photo' => 'required|image|mimes:jpeg,jpg,png,gif',
        'status' => 'nullable',
        'popular' => 'nullable',
        'meta_title' => 'required',
        'meta_description' => 'required|string|max:150',
        'meta_keywords' => 'required|string|max:150'
    ]);

    $category = new Categories();

    $category->category_name = $validate['category_name'];
    $category->slug = $validate['slug'];
    $category->description = $validate['description'];
    $category->status = $request->has('status') ? 1 : 0;
    $category->popular = $request->has('popular') ? 1 : 0;
    $category->meta_title = $validate['meta_title'];
    $category->meta_description = $validate['meta_description'];
    $category->meta_keywords = $validate['meta_keywords'];
    
    if ($request->hasFile('category_photo')){

        $file = $request->file('category_photo');
        $extention = $file->getClientOriginalExtension();
        $filename = time().'.'.$extention;
        $file->move('public/customer/', $filename);

        $category->category_photo = $filename;
          
    }
    
      $category->save();

     return redirect(route('categories.show'));
 
    }

    public function index() {

        $display_data = DB::table('categories')->get();
         
        return view('categories.index', ['categories' => $display_data]);
    }

    public function edit($id) {

        $categories = Categories::find($id);

        return view('categories.edit', compact('categories'));  
    }

     
    public function update(Request $request, $id){

         $validate = $request->validate([
        'category_name' => 'required|string|max:20',
        'slug' => 'required|string',
        'description' => 'required|string|max:150',
        'category_photo' => 'image|mimes:jpeg,jpg,png,gif',
        'status' => 'nullable',
        'popular' => 'nullable',
        'meta_title' => 'required',
        'meta_description' => 'required|string|max:150',
        'meta_keywords' => 'required|string|max:150'
    ]);
    
     $categories = Categories::find($id);
    
      if ($request->hasFile('category_photo')){
        
        $destination = 'public/customer/'.$categories->category_photo;

        if (File::exists($destination)) {

             File::delete($destination);
        }
        
        $file = $request->file('category_photo');
        $extention = $file->getClientOriginalExtension();
        $filename = time().'.'.$extention;
        $file->move('public/customer/', $filename);

        $categories->category_photo = $filename;  
    }

     $categories->save();

     $category_helper = $this->category_helper($validate);

     $category_helper->categoriesData($id);

     return redirect(route('categories.show'));

    }

    public function destroy($id) {
       $categories = Categories::findOrFail($id);

       $categories->delete();

        return redirect(route('categories.show'))->with('status', 'Category Deleted Successfully');
    }

    
}
