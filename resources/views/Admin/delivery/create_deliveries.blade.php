            @extends("layouts.default")
            @section('title','Create Delivery')
            @extends('partials.navbars.admin')
            @section('content') 

            <div class="container py-5"> 
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-primary">
                                    <h4 class="text-white ">Create deliver for Orders
                                        <a href="{{url('myorders')}}" class="btn btn-warning text-white float-end">Back</a>
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="row ">
                                <div class="col-md-6 order-details">
                                    <hr>
                                <form action="{{route('store.delivery')}}" method="post">
                                    @csrf

                                <label for="">Expected Delivered at</label>
                                <input type="date" name="expected_delivery_date" class="form-control form-control-lg bg-light fs-6 mb-3" placeholder="Enter shipped at">
                                
                                <label for="">Delivered at</label>
                                <input type="date" name="delivered_at" class="form-control form-control-lg bg-light fs-6 mb-3" placeholder="Enter delivered at">

                                 <input type="text" name="shipping_id" class="form-control form-control-lg bg-light  fs-6" value="{{$shipping->id}}">

                                <label for="">Delivery status</label>
                                <select name="delivery_status">
                                    <option value="0">Pending</option>
                                    <option value="1">Out for delivery</option>
                                    <option value="2">Delivered</option>
                                    <option value="3 ">Failed</option>
                                </select><br>

                                <button type="submit" class="btn btn-success mt-4">save</button>
            
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

                            