@extends("layouts.default")
@extends('partials.navbars.customer')
@section('title','Address')
@section('content')

<div class="container mt-3 border rounder-10">
    <table class="table table-hover table-striped">
        <thead>

        <tr>
        <th>Id</th>
         <th>Customer Id</th>
         <th>Full Name</th>
         <th>Aternative Email</th>
        <th>Phone Number</th>
        <th>Address</th>
        <th>City</th>
        <th>Province</th>
        <th>Postal Code</th>
        <th>Action</th>

       </tr>

      </thead>
       
      <tbody>
        
    @foreach ($address as $customer_address)
        <tr>
            <td>{{$customer_address->id}}</td>
            <td>{{$customer_address->customer_id}}</td>
            <td>{{$customer_address->FullName}}</td>
            <td>{{$customer_address->email}}</td>
            <td>{{$customer_address->phone_number}}</td>
            <td>{{$customer_address->main_address}}</td>
            <td>{{$customer_address->city}}</td>
            <td>{{$customer_address->province}}</td>
            <td>{{$customer_address->postal_code}}</td>
            </td>

            <td>
                <a class="btn btn-primary w-100 fs-6 mb-3" href="{{route('address.edit', $customer_address->id)}}">Edit</a>
                
                <form  method="post" action="{{route('address.destroy', $customer_address->id)}}">
                    @csrf
                    @method('delete')

                    <button class="btn btn-danger w-100 fs-6 mb-3" >Delete</button>
                </form>
            </td>

        </tr>

    @endforeach

      </tbody>

   </table>
   
    <a class="btn btn-primary mb-2" href="{{route('show.address', Auth::user()->id)}}">Create Address</a>

</div>

@endsection