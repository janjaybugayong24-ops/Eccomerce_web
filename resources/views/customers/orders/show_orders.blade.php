@extends("layouts.default")
@extends('partials.navbars.customer')
@section('title','My Orders')
@section('content')

    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                 <div class="card-header bg-primary">
                    <h4 class="text-white mb-2">My Orders</h4>
                 </div>
                    <div class="card-body">
                <table class="table table-bordered">
                     <thead>
                        <tr>
                            <th>Tracking Number</th>
                            <th>Order Date</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        <tbody>
                            @foreach ($orders as $customer_order)
                           <tr>
                            <td>{{$customer_order->tracking_number}}</td>

                            <td>{{$customer_order->order_date}}</td>

                            <td>{{$customer_order->total_price}}</td>

                            <td>{{$customer_order->order_status == '0' ? 'pending' : 'completed'}}</td>

                            <td>
                                <a href="{{url('view/order/'. $customer_order->id)}}" class="btn btn-primary">View</a>
                            </td>
                           </tr>
                           @endforeach

                        </tbody>
                     </thead>
                </table>
            </div>
        </div>
    </div>
        </div>
    </div>

@endsection