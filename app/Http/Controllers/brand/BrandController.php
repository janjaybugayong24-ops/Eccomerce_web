<?php

namespace App\Http\Controllers\brand;

use App\Http\Controllers\Controller;
use App\Http\Helpers\BrandHelper\BrandHelper;
use App\Models\brand\Brands;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class BrandController extends Controller
{
    private function brand_helper($request)
    {

        return new BrandHelper($request);
    }

    public function create()
    {
        return view('brand.create');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'brand_name' => 'required|string|unique:brands|max:20',
            'slug' => 'required|string|max:150',
            'logo' => 'required|image|mimes:jpeg,jpg,png,gif',
            'status' => 'nullable',
            'description' => 'required|string|max:150'
        ]);

        $brand = new Brands();
        $brand->brand_name = $validate['brand_name'];
        $brand->slug = $validate['slug'];
        $brand->description = $validate['description'];
        $brand->status = $request->has('status') ? 1 : 0;


        if ($request->hasFile('logo')) {

            $file = $request->file('logo');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('public/customer/', $filename);

            $brand->logo = $filename;
        }

        $brand->save();

        // $brand_helper = $this->brand_helper($validate);

        //$brand_helper->brandData();

        return redirect(route('brands.show'));
    }

    public function index()
    {
        $display_data = DB::table('brands')->get();

        return view('brand.index', ['brands' => $display_data]);
    }

    public function edit($id)
    {

        $brands = Brands::find($id);

        return view('brand.edit', compact('brands'));
    }

    public function update(Request $request, $id)
    {

        $validate = $request->validate([
            'brand_name' => 'string|max:20',
            'slug' => 'string|max:150',
            'logo' => 'image|mimes:jpeg,jpg,png,gif',
            'status' => 'nullable',
            'description' => 'string|max:150'
        ]);

        $brand = Brands::find($id);

        if ($request->hasFile('logo')) {

            $destination = 'public/customer/' . $brand->logo;

            if (File::exists($destination)) {

                File::delete($destination);
            }
            $file = $request->file('logo');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('public/customer/', $filename);

            $brand->logo = $filename;
        }

        $brand->save();

        $brand_helper = $this->brand_helper($validate);

        $brand_helper->brandData($id);

        return redirect(route('brands.show'));
    }

    public function destroy($id)
    {
        $brands = Brands::findOrFail($id);

        $brands->delete();

        return redirect(route('brands.show'));
    }
}
