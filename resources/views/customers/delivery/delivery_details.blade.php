@extends("layouts.default")
@section('title','Show Delivery')
@extends('partials.navbars.customer')
@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-12">
                 <div class="card">
                 <div class="card-header bg-primary">
                    <h4 class="text-white">Delivery Details</h4>
                 </div>
                    <div class="card-body">
                <table class="table table-bordered">
                     <thead>
                        <tr>
                            <th>Delivery Id</th>
                            <th>Shipping ID</th>
                            <th>Expected delivery Date</th>
                            <th>Delivered At</th>
                            <th>Status</th>

                        </tr>
                        <tbody>

                           <tr>
                            <td>{{$delivery->id}}</td>

                            <td>{{$delivery->shipping_id}}</td>

                            <td>{{$delivery->expected_delivery_date}}</td>

                            <td>{{$delivery->delivered_at ?? 'TBA'}}</td>
                            
                            @php
                                use App\Http\Helpers\DeliveryHelper\DeliveryHelper;
                                $delivery_data = new DeliveryHelper($delivery);
                            @endphp

                            <td>{{$delivery_data->delivery_status($delivery->delivery_status)}}</td>
                        </tbody>
                     </thead>
                </table>
           </div>
        </div>
    </div>
</div>
</div>

@endsection