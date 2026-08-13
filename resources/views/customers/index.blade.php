@extends("layouts.default")
@extends('partials.navbars.admin')
@section('title','Get Customers')
@section('content')

<div class="container mt-3 border rounder-10">

    <table class="table table-hover table-striped">
        <thead>
        <tr>
        <th>Id</th>
        <th>Username</th>
        <th>Email</th>
        <th>Password</th>
        <th>Photo</th>
        <th>Action</th>
       </tr>

      </thead>
      
      <tbody>
    @foreach ($customers as $customer)
        <tr>
            <td>{{$customer->id}}</td>
            <td>{{$customer->username}}</td>
            <td>{{$customer->email}}</td>
            <td>{{$customer->password}}</td>
            <td>
            <img  src="{{asset('public/customer/'.$customer->photo)}}" alt="Avatar" class="w-100">
            </td>  
           
            </td>
            <td>
                <a class="btn btn-edit" href="{{route('customer.edit', $customer->id)}}">Edit</a>


                <form method="post" action="{{route('customer.destroy', $customer->id)}}">
                    @csrf
                    @method('delete')
                    
                    <button class="btn btn-delete">Delete</button>
                </form>

            </td>
        </tr>

    @endforeach
      </tbody>

   </table>
</div>


@endsection

 
