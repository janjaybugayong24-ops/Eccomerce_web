@extends("layouts.default")
@extends('partials.navbars.customer')
@section('title','Edit Customer')
@section('content')

   <div class="card-register"> 
   <form method="post" action="{{route('customer.update', $customer->id)}}" enctype="multipart/form-data">
    @csrf
    @method('put')

    <label>New Username</label>
    <input type="text" name="username" value="{{$customer->username}}"><br><br>

    <label>New Email</label>
    <input type="email" name="email" value="{{$customer->email}}"><br><br>
    
    <label>New Password</label>
    <input type="password" name="password" value="{{$customer->password}}"><br><br>

    <label for="photo">Add  New Photo</label>
    <input type="file" name="photo" value="{{$customer->photo}}"><br><br>
    <img src="{{asset('public/customer/'.Auth::user()->photo)}}" alt="Avatar" class="img-avatar"><br>

    <input class="btn btn-edit" type="submit" value="Change Customer" >

@if($errors->any())
<ul>
    @foreach($errors->all() as $error)
    <li style="color: red">{{$error}}</li>
    @endforeach
</ul>
@endif

    </form>

    </div>

    @endsection

