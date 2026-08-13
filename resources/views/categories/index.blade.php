@extends("layouts.default")
@section('title','Categories')
@extends('partials.navbars.admin')
@section('content')



<div class="container mt-3 border rounder-10">

    <table class="table table-hover table-striped">

        <thead>
        <tr>
        <th>Id</th>
        <th>Category Name</th>
        <th>Slug</th>
        <th>Description</th>
        <th>Category Photo</th>
        <th>Status</th>
        <th>Popular</th>
        <th>Meta Title</th>
        <th>Meta Description</th>
        <th>Meta Keywords</th>
        <th>Action</th>
       </tr>

      </thead>
      
      <tbody>

    @foreach ($categories as $category)

        <tr>
            <td>{{$category->id}}</td>
            <td>{{$category->category_name}}</td>
            <td>{{$category->slug}}</td>
            <td>{{$category->description}}</td>   
            <td>
            <img src="{{asset('public/customer/'.$category->category_photo)}}" alt="Avatar" class="img-avatar w-50">
            </td>     
            <td>{{$category->status  == TRUE ? 'Active' : 'Inactive'}}</td>
            <td>{{$category->popular}}</td>
            <td>{{$category->meta_title}}</td>
            <td>{{$category->meta_description}}</td>
             <td>{{$category->meta_keywords}}</td>
            <td>

            <a class="btn btn-primary w-100 fs-6 mb-3" href="{{route('categories.edit', $category->id)}}">Edit</a>

            <form method="post" action="{{route('categories.destroy', $category->id)}}">
                
                    @csrf
                    @method('delete')
                    
                    <button class="btn btn-danger w-100 fs-6 mb-3">Delete</button>
                </form>

            </td>
        </tr>

    @endforeach

      </tbody>

   </table>
</div>


@endsection

 <!--
 <a href="{//{route('product.create')}}">Add Product</a>
 <a href="{//{route('product.index')}}">View Product</a>
 <a href="{//{route('orderInfo.index')}}">View Orders Info</a>
 -->
