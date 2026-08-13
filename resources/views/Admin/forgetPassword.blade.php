@extends("layouts.default")
@section('title','Forget pass')
@extends('partials.navbars.admin')
@section('content')

<div class="container d-flex justify-content-center align-items-center min-vh-100">

          <div class="row border rounder-5 p-3 bg-white shadow box-area">

              <div class="col-md-6 rounder-4 d-flex justify-content-center align-items-center flex-column left-box ">

                  <div class="featured-image mb-3">
                       <img src="{{asset('public/customer/1774552376.jpeg')}}"  class="img-fluid" id="img-login"  alt="Avatar" >
                  </div>

                  <p class="text-white fs-2 p-tag">Forget password</p>

                  <small class="text-white text-wrap text-center s-tag">We are happy that you will try our E-Shopping, Best in Asia</small>

              </div>

               <div class="col-md-6 right-box">

                  <div class="row align-items-center">

                         <div class="header-text mb-4">
                          <h2>Hello, Customer</h2>
                          <p>Choose What You Want</p>
                         </div>
                          <form action="{{route('admin_forget_password_submit')}}" method="post">
                          @csrf 
                          @method('post')

                         <div class="input-group mb-3">
                               <input type="email" name="email"  class="form-control form-control-lg bg-light fs-6" required value="{{old('email')}}" placeholder="Email">
                         </div>
                               
                           <div class="input-group mb-3">
                             <button class="btn btn-lg btn-primary w-100 fs-6">Submit</button>
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
