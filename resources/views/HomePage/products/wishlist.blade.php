@extends("layouts.default")
@section('title', 'Wishlist')
@extends('partials.navbars.customer')
@section('content')

<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container">

         <a href="{{url('/')}}" class="text-decoration-none">
            Home /
         </a>

         <a href="{{url('wishlist')}}" class="text-decoration-none">
             Wishlist
       </a>

    </div>
</div>

<div class="container my-5">
    <div class="card shadow WishlistItems">
        <div class="card-body">
             @if($wishlist->count() > 0) 
            @foreach ($wishlist as $wish)
            <div class="row product_data">
                <div class="col-md-2">
                   <img src="{{asset('public/customer/'.$wish->products->product_photo)}}" height="70px" width="70px">
                </div>
                <div class="col-md-2 my-auto">
                    <h6>{{$wish->products->product_name}}</h6>
                </div>
                 <div class="col-md-2 my-auto">
                    <h6> Selling Price: {{$wish->products->selling_price}}</h6>
                </div>
                <div class="col-md-3 my-auto">
                    <input type="hidden" class="product_id" value="{{$wish->product_id}}">
                     @if ($wish->products->stock_quantity > $wish->product_quantity)
                    <label class="Quantity">Quantity</label>
                   <div class="input-group text-center mb-3" style="width: 130px;">
                        <button class="input-group-text decrement-btn">-</button>
                        <input type="text" name="quantity" class="form-control qty-input text-center" value="1">
                        <button class="input-group-text  increment-btn">+</button>
                    </div>
                    @else
                       <h6>Out of Stock</h6>
                    @endif    
                    </div>

                    <div class="col-md-2 my-auto mb-2">
                    <button class="btn btn-success me-3 float-start mb-3 addToCartBtn "><i class="fa-solid fa-cart-shopping"></i>Add To Cart</button>
                    <button class="btn btn-danger delete-wishlist-item"><i class=" fa fa-trash"></i>Remove</button>
                   </div>

                </div>
            @endforeach
             @else
             <h2 class="text-center">Your <i class="fa fa-shopping-cart"></i> Wishlist is Empty</h2>
          @endif
        </div>
        </div>
    </div>


@endsection
