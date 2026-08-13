@extends("layouts.default")
@section('title','Edit Shipping')
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
                    <form action="{{route('update.shipping',$shipping_data->id)}}" method="post">
                        @csrf
                        @method('put')
                    <label for="">Courier</label>
                    <input type="text" name="courier" class="form-control form-control-lg bg-light fs-6 mb-2" placeholder="Enter courier" value="{{$shipping_data->courier}}">

                    <input type="hidden" name="Shipping_id" value="{{$shipping_data->id}}" class="form-control form-control-lg bg-light fs-6 mb-2">

                    <label for="">Order Id</label>
                    <input type="text" name="order_id" value="{{$shipping_data->order_id}}" class="form-control form-control-lg bg-light fs-6 mb-2">

                    <label for="">Tracking number</label>
                    <input type="text" value="{{$shipping_data->tracking_number}}" class="form-control form-control-lg bg-light fs-6 mb-2">

                    <label for="">Shipping status</label>
                     <input type="text" value="Old Status: {{$shipping_data->shipping_status}}" class="form-control form-control-lg bg-light fs-6 mb-2">
                    <select name="shipping_status">
                        <option value="0">Pending</option>
                        <option value="1">Processing</option>
                        <option value="2">Shipped</option>
                        <option value="3">Cancelled</option>
                    </select><br>

                    <label for="">Shipped at</label>
                      <input type="text" value="Old Status: {{$shipping_data->shipped_at}}" class="form-control form-control-lg bg-light fs-6 mb-2">
                    <input type="date" name="shipped_at" class="form-control form-control-lg bg-light fs-6" placeholder="Enter shipped at" value="{{$shipping_data->shipped_at}}">
                       <button type="submit" class="btn btn-success mt-4">Update</button>
                    </div>
                    </div>
                </div>
                 </form>
                </div>

            </div>
        </div>
    </div>
   
     
@endsection