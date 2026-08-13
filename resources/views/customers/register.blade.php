@extends("layouts.default")
@extends('partials.navbars.customer')
@section('title','Register')
@section('content')

 <div class="container d-flex justify-content-center align-items-center min-vh-100">

          <div class="row border rounder-5 p-3 bg-white shadow box-area">

              <div class="col-md-6 rounder-4 d-flex justify-content-center align-items-center flex-column left-box ">

                  <div class="featured-image mb-3">
                       <img src="{{asset('public/customer/eshopping_logo.png')}}"  class="img-fluid" id="img-login"  alt="Avatar" >
                  </div>

                  <p class="text-white fs-2 p-tag">Register-Customer</p>

                  <small class="text-white text-wrap text-center s-tag">We are happy that you will try our E-Shopping, Best in Asia</small>

              </div>

               <div class="col-md-6 right-box">

                  <div class="row align-items-center">

                         <div class="header-text mb-4">
                          <h2>Hello, Customer</h2>
                          <p>Kindly Register Account</p>
                         </div>
                          <form action="{{route('register')}}" method="post" enctype="multipart/form-data">
                          @csrf
                          @method('post')
                        <div class="input-group mb-3">
                              <input type="text" class="form-control form-control-lg bg-light fs-6" name="username" required value="{{old('username')}}" placeholder="Username">
                         </div>

                         <div class="input-group mb-3">
                              <input type="email" class="form-control form-control-lg bg-light fs-6" name="email" required value="{{old('email')}}" placeholder="Email">
                         </div>
                               
                          <div class="input-group mb-3">
                             <input type="password" class="form-control form-control-lg bg-light fs-6" name="password" required placeholder="Password">
                          </div>

                          <div class="input-group mb-3">
                             <input type="password" class="form-control form-control-lg bg-light fs-6" name="password_confirmation" required placeholder="Confirm Password">
                          </div>
                          
                         <div class="input-group mb-3">
                         <input type="file" name="photo">
                         </div>

                           <div class="input-group mb-5 d-flex justify-content-between">
                               <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="formCheck">
                                <label for="formCheck" class="form-check-label text-secondary"><small>Remember Me</small></label>
                               </div>
                                <div class="forgot">
                            <small> <a href="{{route('login')}}">Already have Account?</a><br></small>
                          </div>
                          </div>
                          
                           <div class="input-group mb-3">
                             <button class="btn btn-lg btn-primary w-100 fs-6">Register</button>
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