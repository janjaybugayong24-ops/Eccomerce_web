@extends("layouts.default")
@extends('partials.navbars.admin')
@section('partials.sidebars.admin')
@endsection
@section('title')
Dashbord Admin
@endsection

@section('content')
<h1 class="d-flex justify-content-center p-4">Dashbord</h1>
<div class="container p-10">
    <div class="row">
        <div class="col-md-12">
           <div class="card">
            <div class="card-body p3">
               <div class="border p-3 mb-3">
                <h1>Products</h1>
                  <p>Total Products: {{$total_products}}</p>   
               </div>

               <div class="border mb-3">
                <h1>Categories</h1>
                  <p>Total Categories: {{$categories}}</p> 
               </div>

                <div class="border mb-3">
                <h1>Brands</h1>
                  <p>Total Brands: {{$brands}}</p> 
               </div>

                <div class="border mb-3">
                <h1>Registered Customers</h1>
                  <p>Total Customers: {{$customer_count}}</p> 
               </div>


               <div class="border mb-3">
                <h1>Pending Orders</h1>
                <p>Total: {{$pending_orders}}</p>
               </div>


               <div class="border">
                <h1>Completed Orders</h1>
                <p>Total: {{$completed_orders}}</p>
               </div>



            </div>
           </div>
        </div>
    </div>
</div>

@endsection

