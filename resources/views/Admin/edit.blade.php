@extends("layouts.default")
@section('title','Edit')
@extends('partials.navbars.admin')
@section('content')

<div class="card-register"> 
   <form method="post" action="{{route('admin.update', $admin->id)}}" enctype="multipart/form-data">
    @csrf
    @method('put')

    <label>New Adminname</label>
    <input type="text" name="adminname" value="{{$admin->adminname}}"><br><br>

    <label>New Email</label>
    <input type="email" name="email" value="{{$admin->email}}"><br><br>
    
    <label>New Password</label>
    <input type="password" name="password" value="{{$admin->password}}"><br><br>

    <label for="photo">Add  New Photo</label>
    <input type="file" name="photo" value="{{$admin->photo}}"><br><br>
    <img src="{{asset('public/customer/'.Auth::guard('admins')->user()->photo)}}" alt="Avatar" class="img-avatar"><br>

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