@extends("layouts.default")
@section('title','Edit Delivery')
@extends('partials.navbars.admin')
@section('content')
                        
  <div class="container py-5">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header bg-primary">
                                            <h4 class="text-white ">Edit deliver for Orders
                                                <a href="{{url('myorders')}}" class="btn btn-warning text-white float-end">Back</a>
                                            </h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row ">
                                        <div class="col-md-6 order-details">
                                            <hr>
                                        <form action="{{route('deliveries.update', $delivery->id)}}" method="post">
                                            @csrf
                                            @method('put')

                                        <label for="">Expected Deliverey Date</label>
                                        <input type="date" name="expected_delivery_date" class="form-control form-control-lg bg-light fs-6 mb-3" placeholder="Enter shipped at" value="{{$delivery->expected_delivery_date}}">
                                        
                                        <label for="">Delivered at</label>
                                        <input type="date" name="delivered_at" class="form-control form-control-lg bg-light fs-6 mb-3" placeholder="Enter delivered at" value="{{$delivery->delivered_at}}">

                                        <label for="">Delivery status</label>
                                        <input type="text" name="delivery_status" class="form-control form-control-lg bg-light  fs-6 mb-3" value="Old status: {{$delivery->delivery_status}}">
                                        <select name="delivery_status">
                                            <option value="0">Pending</option>
                                            <option value="1">Out for delivery</option>
                                            <option value="2">Delivered</option>
                                            <option value="3 ">Failed</option>
                                        </select><br>

                                        <input type="text" name="shipping_id" class="form-control form-control-lg bg-light  fs-6 mt-3" value="{{$delivery->shipping_id}}">

                                         <input type="hidden" name="delivery_id" class="form-control form-control-lg bg-light  fs-6 mt-3" value="{{$delivery->id}}">

                                        <button type="submit" class="btn btn-success mt-4">Update</button>
                    
                                            </form>
                                        </div>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    </form>
                                    </div>

@endsection

                                    