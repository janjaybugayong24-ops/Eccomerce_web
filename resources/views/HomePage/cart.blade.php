@extends("layouts.default")
@section('title', 'My Cart')
@extends('partials.navbars.customer')
@section('content')

<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container">

         <a href="{{url('/')}}" class="text-decoration-none">
            Home /
         </a>

         <a href="{{url('cart')}}" class="text-decoration-none">
             Cart
       </a>

    </div>
</div>

<div class="container my-5">
    <div class="card shadow CartItems">
        @if($cart_items->count() > 0)
        <div class="card-body">
            @php $total = 0; @endphp
            @foreach ($cart_items as $cart_item)
            <div class="row product_data">
                <div class="col-md-2">
                   <img src="{{asset('public/customer/'.$cart_item->products->product_photo)}}" height="70px" width="70px">
                </div>
                <div class="col-md-3 my-auto">
                    <h6>{{$cart_item->products->product_name}}</h6>
                </div>
                 <div class="col-md-2 my-auto">
                    <h6> Selling Price: {{$cart_item->products->selling_price}}</h6>
                </div>
                <div class="col-md-3 my-auto">
                    <input type="hidden" class="product_id" value="{{$cart_item->product_id}}">
                     @if ($cart_item->products->stock_quantity > $cart_item->product_quantity)
                    <label class="Quantity">Quantity</label>
                   <div class="input-group text-center mb-3" style="width: 130px;">
                        <button class="input-group-text change_quantity decrement-btn">-</button>
                        <input type="text" name="quantity" class="form-control qty-input text-center" value="{{$cart_item->product_quantity}}">
                        <button class="input-group-text change_quantity increment-btn">+</button>
                        </div>
                        @php $total += $cart_item->products->selling_price * $cart_item->product_quantity; @endphp
                    @else
                       <h6>Out of Stock</h6>
                    @endif    
                    </div>
                    <div class="col-md-2 my-auto">
                    <button class="btn btn-danger delete-cart-item "><i class=" fa fa-trash"></i>Remove</button>
                    </div>

                    
                </div>
            @endforeach
            </div>
             <div class="card-footer">
                <h6>Total Price: {{$total}} Pesos</h6>
                <a href="{{route('show.checkout')}}" class="btn btn-outline-success float-end">Checkout</a>
           </div>
           @else
           <div class="card-body text-center">
            <h2>Your <i class="fa fa-shopping-cart"></i> Cart is Empty</h2>
            <a href="{{route('show.category')}}" class="btn btn-outline-primary float-end">Continue Shopping</a>
           </div>
           @endif
        </div>
    </div>


@endsection
