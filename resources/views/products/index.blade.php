@extends("layouts.default")
@section('title','Products')
@extends('partials.navbars.admin')
@section('content')

<div class="container mt-3 border rounder-10">

    <table class="table table-hover table-striped">

        <thead>
        <tr>
        <th>Id</th>
        <th>Product Name</th>
        <th>Category</th>
        <th>Brand</th>
        <th>Slug</th>
        <th>Product Photo</th>
        <th>Description</th>
        <th>Stock Quantity</th>
        <th>Price</th>
        <th>Selling Price</th>
        <th>Status</th>
        <th>Trending</th>
        <th>Meta Title</th>
        <th>Meta Description</th>
        <th>Meta Keywords</th>
        <th>Action</th>
       </tr>

      </thead>
      
      <tbody>

    @foreach ($products as $product)

        <tr>
            <td>{{$product->id}}</td>
            <td>{{$product->product_name}}</td>
            <td>{{$product->category->category_name}}</td>
            <td>{{$product->brand->brand_name}}</td>  
            <td>{{$product->slug}}</td> 
            <td>
            <img class="w-100" src="{{asset('public/customer/'.$product->product_photo)}}" alt="Avatar" class="img-avatar">
            </td>  
            <td>{{$product->meta_description}}</td>   
            <td>{{$product->stock_quantity}}</td>
            <td>{{$product->price}}</td>
            <td>{{$product->selling_price}}</td>
            <td>{{$product->status  == TRUE ? 'In stock' : 'Out fo stock'}}</td>
            <td>{{$product->trending == TRUE ? 'Trending' : 'Not trending'}}</td>
            <td>{{$product->meta_title}}</td>
            <td>{{$product->description}}</td>
            <td>{{$product->meta_keywords}}</td>
            <td> 
            <a  class="btn btn-primary w-100 fs-6 mb-3 " href="{{route('product.edit', $product->id)}}">Edit</a>
           
            <form method="post" action="{{route('product.destroy', $product->id)}}">
                
                    @csrf
                    @method('delete')
                    
                    <button class="btn  btn-danger w-100 fs-6 ">Delete</button>
                </form>

            </td>
        </tr>

    @endforeach

      </tbody>

   </table>
</div>

@endsection

 