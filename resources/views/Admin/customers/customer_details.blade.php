@extends("layouts.default")
@section('title','Customer details')
@extends('partials.navbars.admin')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header">
            <h4>Customers Details
                <a class="btn btn-primary btn-sm float-end" href="{{asset('admins/customer/registered')}}">Back</a>
            </h4>
            <hr>
          </div>
         <div class="card-body">
             <div class="row">
                <div class="col-md-4 mt-3">
                    <label for="">Full Name</label>
                    <div class="p-2 border">{{$customer->address->FullName}}</div>
                </div>

                 <div class="col-md-4 mt-3">
                    <label for="">Email</label>
                    <div class="p-2 border">{{$customer->address->email}}</div>
                </div>

                 <div class="col-md-4 mt-3">
                    <label for="">Phone</label>
                    <div class="p-2 border">{{$customer->address->phone_number ?? 'Empty'}}</div>
                </div>

                 <div class="col-md-4 mt-3">
                    <label for="">Main Address</label>
                    <div class="p-2 border">{{$customer->address->main_address}}</div>
                </div>

                <div class="col-md-4 mt-3">
                    <label for="">City</label>
                    <div class="p-2 border">{{$customer->address->city}}</div>
                </div>

                <div class="col-md-4 mt-3">
                    <label for="">Province</label>
                    <div class="p-2 border">{{$customer->address->province}}</div>
                </div>

                <div class="col-md-4 mt-3">
                    <label for="">Postal Code</label>
                    <div class="p-2 border">{{$customer->address->postal_code}}</div>
                </div>
             </div>
          </div>
         </div>
       </div>
      </div>
    </div>

@endsection


 
 



