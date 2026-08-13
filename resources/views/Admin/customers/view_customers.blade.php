@extends("layouts.default")
@section('title','Active Users')
@extends('partials.navbars.admin')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
                 <div class="card">
                 <div class="card-header bg-primary">
                    <h4 >Active Users</h4>
                 </div>
                    <div class="card-body">
                <table class="table table-bordered table-striped">
                     <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Last seen</th>
                            <th>Status</th>
                            <th>Photo</th>
                            <th>Action</th>
                        </tr>
                        <tbody>

                            @foreach ($customerActive as $customer)
                           <tr>
                             <td>{{$customer->id}}</td>

                             <td>{{$customer->username}}</td>

                             <td>{{$customer->email}}</td>  

                             <td>{{Carbon\Carbon::parse($customer->last_seen)->diffForHumans()}}</td>

                             <td>
                                <span class="bg-{{$customer->last_seen >= now()->subMinutes(2) ? 'success' : 'danger'}}-500 text-black py-1 px-3 rounded-full text-lg">

                                {{$customer->last_seen >= now()->subMinutes(2) ? 'Online' : 'Offline'}}
                                </span>
                            
                            </td>

                             <td>
                             <img style="width: 150px; height: 150;" src="{{asset('public/customer/'.$customer->photo)}}" alt="user_photo" >
                             </td>  
                            <td>
                                <a href="{{url('admins/customer/view/'.$customer->id)}}" class="btn btn-primary">View</a>
                            </td>
                           </tr>
                           @endforeach
                        </tbody>
                     </thead>
                </table>
           </div>
        </div>
    </div>
</div>

@endsection


 
 



