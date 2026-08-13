@extends('layouts.default')
@section('title', 'Checkout')
@extends('partials.navbars.customer')
@section('content')


<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container">

         <a href="{{url('/')}}" class="text-decoration-none">
            Home /
         </a>

         <a href="{{url('show.checkout')}}" class="text-decoration-none">
             Cart
       </a>

    </div>
</div>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                     <h6>Basic Details</h6>
                     <hr>
                      <form action="{{route('create.place_order', Auth::user()->id)}}" method="post" enctype="multipart/form-data">
                          @csrf
                          @method('post')
                     <div class="row checkout-form">
                          
                          <div class="col-md-6">
                            <label for="">FullName</label>
                            <input type="text" class="form-control fullname" value="{{$address->FullName}}">
                            <span id="fname_error" class="text-danger"></span>
                        </div>

                          <div class="col-md-6 mt-3">
                             <label for="">Email</label>
                            <input type="text" class="form-control email"  value="{{$address->email}}">
                              <span id="email_error" class="text-danger"></span>
                        </div>

                          <div class="col-md-6 mt-3">
                            <label for="">Phone#</label>
                            <input type="text" class="form-control phone"  value="{{$address->phone_number}}">
                           <span id="phone_error" class="text-danger"></span>
                         </div>

                          <div class="col-md-6 mt-3">
                            <label for="">Main Address</label>
                            <input type="text" class="form-control main_address"  value="{{$address->main_address}}">
                            <span id="address_error" class="text-danger"></span>
                          </div>

                          <div class="col-md-6 mt-3">
                             <label for="">City</label>
                            <input type="text" class="form-control city"  value="{{$address->city}}">
                            <span id="city_error" class="text-danger"></span>
                          </div>

                          <div class="col-md-6 mt-3">
                            <label for="">Province</label>
                            <input type="text" class="form-control province"  value="{{$address->province}}">
                            <span id="province_error" class="text-danger"></span>
                        </div>

                          <div class="col-md-6 mt-3">
                            <label for="">Postal Code</label>
                            <input type="text" class="form-control postal_code"  value="{{$address->postal_code}}">
                            <span id="postal_error" class="text-danger"></span>
                        </div>


                           <div class="col-md-6 mt-3">
                            <label class="mb-2">Message</label>
                            <div class="form-floating">
                           <textarea class="form-control message"  name="message" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                        </div>
                          </div>

                     </div>
                     </div>
                </div>
            </div>

             <div class="col-md-5">
              <div class="card">
                 <div class="card-body">
                      <h6>Order Details</h6>
                       <hr>
                       @if ($cart_items->count() > 0)
                        <table class="table table-striped table-bordered">
                            <thead>
                                 <tr>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Selling Price</th>
                                 </tr>
                               </thead>
                                 <tbody>
                                    @php
                                        $total_price = 0;
                                    @endphp
                                 @foreach($cart_items as $cart_item)
                                <tr>
                                    @php
                                        $total_price += $cart_item->products->selling_price * $cart_item->product_quantity;
                                    @endphp
                                  <td>{{$cart_item->products->product_name}}</td>
                                  <td>{{$cart_item->product_quantity}}</td>
                                  <td>{{$cart_item->products->selling_price}}</td>
                                  <td></td>
                                </tr>
                                @endforeach
                            </tbody>
                     </table>   
                      <h6 class="px-2">Grand Total: <span class="float-end">{{$total_price}}</span></h6>
                     <hr>     
                     <button type="submit" class="btn btn-success float-end w-100 mb-2">Place Order | COD</button>    
                     <a type="button" class="btn btn-primary w-100 " href="{{url('pay')}}">Pay with Paymongo</a>           
                    @else
                    <h4 class="text-center">No products in your cart.</h4>
                    @endif
                    </div>
              </div>
          </div>
        </div>
    </form>
    </div>

@endsection
