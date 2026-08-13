
@extends("layouts.default")
@section('title', $category->category_name)
@extends('partials.navbars.customer')
@section('content')

<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container">
        <h6 class="mb-0">Collections / {{$category->category_name}}</h6>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="row">
          <h4>{{$category->category_name}}</h4>
        @foreach($products as $product)
        <div class="col-md-3 mb-3">
         <a href="{{url('category/'.$category->slug. '/' .$product->slug)}}" class="text-decoration-none">
         <div class="card">
            <img src="{{asset('public/customer/'.$product->product_photo)}}" alt="Product Image">
            <div class="card-body">
            <h5>{{$product->product_name}}</h5>
            <span class="float-start">{{$product->selling_price}}</span>
            <span class="float-end"><s>{{$product->price}}</s></span>
          </div>
         </div>
         </a>
        </div>
        @endforeach
        </div>
    </div>
 </div>

@endsection