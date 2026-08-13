@extends("layouts.default")
@extends('partials.navbars.customer')
@section('title','View Orders')
@section('content')
     
   <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white ">Orders View
                            <a href="{{url('myorders')}}" class="btn btn-warning text-white float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row ">
                    <div class="col-md-6 order-details">
                        <h4>Shipping Details</h4>
                         <hr>
                    <label for="">Full Name</label>
                    <div class="border ">{{$address->FullName}}</div>
                    <label for="">Email</label>
                    <div class="border ">{{$address->email}}</div>
                    <label for="">Phone#</label>
                    <div class="border ">{{$address->phone_number}}</div>
                    <label for="">Shipping Address</label>
                    <div class="border ">
                       {{$address->main_address}} <br>
                       {{$address->city}} <br>
                       {{$address->province}}
                    </div>

                    <label for="">Postal Code</label>
                    <div class="border p-2">{{$address->postal_code}}</div>
                    </div>
            <div class="col-md-6">
                <h4>Order Details</h4>
                <hr>
                <table class="table table-bordered">
                     <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Order date</th>
                            <th>Image</th>
                        </tr>
                        <tbody>
                            @foreach ($orders->order_items as $customer_order)
                           <tr>
                            <td class="text-center">{{$customer_order->products->product_name}}</td>

                            <td  class="text-center">{{$customer_order->quantity}}</td>

                            <td  class="text-center">{{$customer_order->price}}</td>

                            <td  class="text-center">{{$orders->order_date}}</td>

                           <td>
                             <img src="{{asset('public/customer/'.$customer_order->products->product_photo)}}" alt="Product image" class="img-avatar w-50 mx-auto d-block">
                           </td>
                           </tr>
                           @endforeach

                        </tbody>
                     </thead>
                </table>
                <h4 class="px-2">Grand Total: <span class="float-end">{{$orders->total_price}}</span></h4>
                <a href="{{route('shipping.details', $orders->id)}}" class="btn btn-success">View Shipping</a>
                    </div>
                </div>
                </div>

            </div>
        </div>
    </div>
   </div>

@endsection