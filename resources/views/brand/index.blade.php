
@extends("layouts.default")
@section('title','Brands')
@extends('partials.navbars.admin')
@section('content')

<div class="container mt-3 border rounder-10">

    <table class="table table-hover table-striped">

        <thead>
        <tr>
        <th>Id</th>
        <th>Brand Name</th>
        <th>Slug</th>
        <th>Description</th>
        <th>Status</th>
        <th>Logo</th>
        <th>Action</th>
       </tr>
       </tr>

      </thead>
      
      <tbody>

    @foreach ($brands as $brand)

        <tr>
           <td>{{$brand->id}}</td>
            <td>{{$brand->brand_name}}</td>
            <td>{{$brand->slug}}</td>

            <td>{{$brand->description}}</td> 
            <td>{{$brand->status == TRUE ? 'Active' : 'Inactive'}}</td>  
            <td>
            <img src="{{asset('public/customer/'.$brand->logo)}}" alt="Avatar" class="img-avatar w-50 h-50">
            </td> 
            <td> 
            <a  class="btn btn-primary w-100 fs-6 mb-3 " href="{{route('brands.edit', $brand->id)}}">Edit</a>
           
            <form method="post"action="{{route('brands.destroy', $brand->id)}}">
                
                    @csrf
                    @method('delete')
                    
                    <button class="btn btn-danger w-100 fs-6 ">Delete</button>
                </form>

            </td>
        </tr>

    @endforeach

      </tbody>

   </table>
</div>

@endsection

 