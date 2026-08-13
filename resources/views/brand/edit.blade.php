
@extends("layouts.default")
@section('title','Edit Brands')
@extends('partials.navbars.admin')
@section('content')

 <div class="container d-flex justify-content-center align-items-center min-vh-100">

          <div class="row border rounder-5 p-3 bg-white shadow box-area">

              <div class="col-md-6 rounder-4 d-flex justify-content-center align-items-center flex-column left-box ">

                  <div class="featured-image mb-3">
                       <img src="{{asset('public/customer/1774552376.jpeg')}}"  class="img-fluid" id="img-login"  alt="Avatar" >
                  </div>

                  <p class="text-white fs-2 p-tag">Edit(Brand)</p>

                  <small class="text-white text-wrap text-center s-tag">We are happy that you will try our E-Shopping, Best in Asia</small>

              </div>

               <div class="col-md-6 right-box">

                  <div class="row align-items-center">

                         <div class="header-text mb-4">
                          <h2>Admin</h2>
                          <p>Hello Admin</p>
                         </div>
                          <form action="{{route('brands.update', $brands->id)}}" method="post" enctype="multipart/form-data">
                          @csrf 
                          @method('put')

                         <div class="input-group mb-3">
                              <input type="text" class="form-control form-control-lg bg-light fs-6" name="brand_name" required value="{{$brands->brand_name}}">
                         </div>

                          <div class="input-group mb-3">
                              <input type="text" class="form-control form-control-lg bg-light fs-6" name="slug" required placeholder="Slug" value="{{$brands->slug}}">
                         </div>
                               
                         <div class="input-group mb-3">
                            <div class="form-floating">
                           <textarea class="form-control"  name="description" placeholder="Leave a comment here" id="floatingTextarea">{{$brands->description}}</textarea>
                          <label for="floatingTextarea">Description</label> 
                         </div>
                          </div>


                        <div class="input-group mb-2 d-flex justify-content-between">
                                <div class="form-check">
                                <input type="hidden" value="0" name="status">
                                <input type="checkbox" class="form-check-input" id="formCheck" name="status" {{$brands->status == "1" ? 'checked': ""}}>
                                <label for="formCheck" class="form-check-label text-secondary"><small>Status</small></label>
                               </div>
                          </div>

                       <div class="input-group mb-3">
                        @if($brands->logo)
                       <img src="{{asset('public/customer/'.$brands->logo)}}" alt="Brand photo" class="form-control form-control-lg bg-light fs-6">
        
                        <input type="file" name="logo" placeholder="New image">
                        @endif
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


