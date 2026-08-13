@extends("layouts.default")
@section('title','Edit Product')
@extends('partials.navbars.admin')
@section('content')

 <div class="container d-flex justify-content-center align-items-center min-vh-100">

          <div class="row border rounder-5 p-3 bg-white shadow box-area">

              <div class="col-md-6 rounder-4 d-flex justify-content-center align-items-center flex-column left-box ">

                  <div class="featured-image mb-3">
                       <img src="{{asset('public/customer/1774552376.jpeg')}}"  class="img-fluid" id="img-login"  alt="Avatar" >
                  </div>

                  <p class="text-white fs-2 p-tag">Edit(Product)</p>

                  <small class="text-white text-wrap text-center s-tag">We are happy that you will try our E-Shopping, Best in Asia</small>

              </div>

               <div class="col-md-6 right-box">

                  <div class="row align-items-center">

                         <div class="header-text mb-4">
                          <h2>Hello, Customer</h2>
                          <p>Choose What You Want</p>
                         </div>
                          <form method="post" action="{{route('product.update', $product->id)}}"  enctype="multipart/form-data">
                          @csrf 
                          @method('put')

                         <div class="input-group mb-3">
                              <input type="text" class="form-control form-control-lg bg-light fs-6" name="product_name" required value="{{$product->product_name}}" placeholder="New Product">
                         </div>
                               
                          <div class="input-group mb-3">
                             <input type="text" class="form-control form-control-lg bg-light fs-6" name="slug" required placeholder="New Slug" value="{{$product->slug}}">
                          </div>

                          <div class="input-group mb-3">
                             <input type="text" class="form-control form-control-lg bg-light fs-6" name="stock_quantity" required placeholder="New Stock Quantity" value="{{$product->stock_quantity}}">
                          </div>

                           <div class="input-group mb-2 d-flex justify-content-between">
                               <div class="form-check">
                                <input type="hidden" value="0" name="status">
                                <input type="checkbox" class="form-check-input " id="formCheck" name="status"  {{$product->status == "1" ? 'checked': ""}}>
                                <label for="formCheck" class="form-check-label text-secondary"><small>Status</small></label>
                               </div>
                          </div>

                           <div class="input-group mb-2 d-flex justify-content-between">
                               <div class="form-check">
                                <input type="hidden" value="0" name="trending">
                                <input type="checkbox" class="form-check-input" id="formCheck" name="trending"  {{$product->trending == "1" ? 'checked': ""}}>
                                <label for="formCheck" class="form-check-label text-secondary"><small>Trending</small></label>
                               </div>
                          </div>

                          <div class="input-group mb-3">
                             <input type="text" class="form-control form-control-lg bg-light fs-6" name="meta_title" required placeholder="New Meta Title" value="{{$product->meta_title}}">
                          </div>

                          <div class="input-group mb-3">
                            <div class="form-floating">
                           <textarea class="form-control"  name="description" placeholder="Leave a comment here" id="floatingTextarea" >{{$product->description}}</textarea>
                          <label for="floatingTextarea">New Description</label> 
                         </div>
                          </div>

                          <div class="input-group mb-3">
                            <div class="form-floating">
                           <textarea class="form-control"  name="meta_keywords" placeholder="Leave a comment here" id="floatingTextarea">{{$product->meta_keywords}}</textarea>
                          <label for="floatingTextarea">New Meta Keywords</label> 
                         </div>
                          </div>

                           <div class="input-group mb-3">
                            <div class="form-floating">
                           <textarea class="form-control"  name="meta_description" placeholder="Leave a comment here" id="floatingTextarea">{{$product->meta_description}}</textarea>
                          <label for="floatingTextarea">New Meta Description</label> 
                         </div>
                          </div>

                          <div class="input-group mb-3">
                          <input type="text"  class="form-control form-control-lg bg-light fs-6" name="price" placeholder="New Orginal Price" value="{{$product->price}}">
                          </div>

                          <div class="input-group mb-3">
                          <input type="text"  class="form-control form-control-lg bg-light fs-6" name="selling_price" placeholder="New Selling Price" value="{{$product->selling_price}}">
                          </div>

                       <div class="input-group mb-3">
                       <select class="form-select"  name="category_id" aria-label="Default select example">
                       <option value="">New Select Category</option>

                        @foreach ($category as $categories)
                       <option value="{{$categories->id}}">{{$categories->category_name}}</option>
                       @endforeach
                       </select>
                       </div>

                        <div class="input-group mb-3">
                        <select class="form-select" name="brand_id" aria-label="Default select example">
                        <option value="">New Select Brand</option>

                       @foreach ($brand as $brands)
                      <option value="{{$brands->id}}">{{$brands->brand_name}}</option>
                      @endforeach
                      </select>
                      </div>
                      
                      
                     <div class="input-group mb-3">
                       @if($categories->category_photo)
                      <img src="{{asset('public/customer/'.$product->product_photo)}}" alt="product photo" class="form-control form-control-lg bg-light fs-6">
    
                     <input type="file" name="product_photo" placeholder="New image">
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


