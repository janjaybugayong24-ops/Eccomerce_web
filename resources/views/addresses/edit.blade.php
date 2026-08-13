@extends("layouts.default")
@section('title','Edit Address')
@extends('partials.navbars.customer')
@section('content')


<div class="container d-flex justify-content-center align-items-center min-vh-100">

          <div class="row border rounder-5 p-3 bg-white shadow box-area">

              <div class="col-md-6 rounder-4 d-flex justify-content-center align-items-center flex-column left-box ">

                  <div class="featured-image mb-3">
                       <img src="{{asset('public/customer/1774552376.jpeg')}}"  class="img-fluid" id="img-login"  alt="Avatar" >
                  </div>

                  <p class="text-white fs-2 p-tag">Edit Address</p>

                  <small class="text-white text-wrap text-center s-tag">Edit Your address</small>

              </div>

               <div class="col-md-6 right-box">

                  <div class="row align-items-center">

                         <div class="header-text mb-4">
                          <h2>Hello, Customer</h2>
                          <p>Kindly Register your account, to have access to our affordable Products.</p>
                         </div>
                          <form action="{{route('address.update', $address->id)}}" method="post" enctype="multipart/form-data">
                          @csrf
                          @method('put')

                        <div class="input-group mb-3">
                              <input type="text" class="form-control form-control-lg bg-light fs-6" name="FullName" value="{{$address->FullName}}">
                         </div>

                         <div class="input-group mb-3">
                              <input type="email" class="form-control form-control-lg bg-light fs-6" name="email" value="{{$address->email}}">
                         </div>

                        <div class="input-group mb-3">
                              <input type="text" class="form-control form-control-lg bg-light fs-6" name="phone_number" value="{{$address->phone_number}}">
                         </div>

                         <div class="input-group mb-3">
                              <input type="text" class="form-control form-control-lg bg-light fs-6" name="main_address" required value="{{$address->main_address}}">
                         </div>

                          <div class="input-group mb-3">
                              <input type="text" class="form-control form-control-lg bg-light fs-6" name="city" required value="{{$address->city}}">
                         </div>

                          <div class="input-group mb-3">
                              <input type="text" class="form-control form-control-lg bg-light fs-6" name="province" required value="{{$address->province}}">
                         </div>

                          <div class="input-group mb-3">
                              <input type="text" class="form-control form-control-lg bg-light fs-6" name="postal_code" required value="{{$address->postal_code}}">
                         </div>

                           <div class="input-group mb-3">
                             <button class="btn btn-lg btn-primary w-100 fs-6">Edit</button>
                           </div>

                           <div class="mb-3">
                             @if($errors->any())
                             <ul>
                             @foreach($errors->all() as $error)
                               <li style="color: red">{{$error}}</li>
                             @endforeach
                            </ul> 
                           @endif
                              @if(session('success'))
                              {{session('success')}}
                              @endif

                              @if(session('error'))
                              {{session('error')}}
                              @endif   

                           </div>
                          </form>
                   </div >
               </div>
          </div>
     </div>

@endsection
     