@extends("layouts.default")
@section('title','Shipping details')
@extends('partials.navbars.customer')
@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-12">
                 <div class="card">
                 <div class="card-header bg-primary">
                    <h4 class="text-white">Shipping Details</h4>
                 </div>
                    <div class="card-body">
                <table class="table table-bordered">
                     <thead>
                        <tr>
                            <th>Shipping Id</th>
                            <th>Order ID</th>
                            <th>Tracking Number</th>
                            <th>Shipped At</th>
                            <th>Status</th>
                            <th>Action</th>

                        </tr>
                        <tbody>

                           <tr>
                            <td>{{$shipping_data->id}}</td>

                            <td>{{$shipping_data->order_id}}</td>

                            <td>{{$shipping_data->tracking_number}}</td>

                            <td>{{$shipping_data->shipped_at}}</td>
                            
                            @php
                            use App\Http\Helpers\ShippingHelper\ShippingHelper;
                             $shipping_helper = new ShippingHelper($shipping_data);
                            @endphp
                            <td>{{ $shipping_helper->shipping_status($shipping_data->shipping_status)}}</td> 
                            
                            <td><a href="{{route('delivery.details', $shipping_data->id)}}" class="btn btn-success">Delivery details</a></td>
                        </tbody>
                     </thead>
                </table>
           </div>
        </div>
    </div>
</div>
</div>

@endsection