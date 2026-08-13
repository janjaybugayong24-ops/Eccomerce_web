@extends("layouts.default")
@section('title','Create Shipping')
@extends('partials.navbars.admin')
@section('content')


<div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white ">Shipping Orders
                            <a href="{{url('myorders')}}" class="btn btn-warning text-white float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row ">
                    <div class="col-md-6 order-details">
                         <hr>
                    <form action="{{route('create.shipping')}}" method="post">
                        @csrf

                    <label for="">Courier</label>
                    <input type="text" name="courier" class="form-control form-control-lg bg-light fs-6 mb-2" placeholder="Enter courier">

                    <label for="">Shipping status</label>
                    <select name="shipping_status">
                        <option value="0">Pending</option>
                        <option value="1">Processing</option>
                        <option value="2">Shipped</option>
                        <option value="3 ">Cancelled</option>
                    </select><br>


                    <label for="">Shipped at</label>
                    <input type="date" name="shipped_at" class="form-control form-control-lg bg-light fs-6" placeholder="Enter shipped at">
                    </div>

                    <input type="hidden" name="order_id"value="{{$check_order->id}}">

                      <div class="col-md-6">
                <h4>Order Details</h4>
                <hr>
                <table class="table table-bordered">
                     <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Order Tracking number</th>
                            <th>Price</th>
                            <th>Order date</th>
                            <th>Image</th>
                        </tr>
                        <tbody>
                            @foreach ($check_order->order_items as $customer_order)
                           <tr>
                            <td class="text-center">{{$customer_order->products->product_name}}</td>

                            <td  class="text-center">{{$customer_order->quantity}}</td>
                            
                            <td  class="text-center">{{$check_order->tracking_number}}</td>


                            <td  class="text-center">{{$customer_order->price}}</td>

                            <td  class="text-center">{{$check_order->order_date}}</td>

                           <td>
                             <img src="{{asset('public/customer/'.$customer_order->products->product_photo)}}" alt="Product image" class="img-avatar w-50 mx-auto d-block">
                           </td>
                           </tr>
                           @endforeach

                        </tbody>
                     </thead>
                </table>
                <h4 class="px-2">Grand Total: <span class="float-end">{{$check_order->total_price}}</span></h4>
                 <button type="submit" class="btn btn-success float-end mt-2">Shipped it</button>
                    </div>
                </div>
                 </form>
                </div>

            </div>
        </div>
    </div>
   </div>
     
@endsection