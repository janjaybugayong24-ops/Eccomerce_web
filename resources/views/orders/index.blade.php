@extends("includes.content")
@section('title','Get order Information')
@section('content')
<h1>Order Information</h1>

<div>
     <table border='1'>
        <thead>
       <tr>
        <th>Full name</th>
        <th>Email</th>
        <th>Product</th>
        <th>Quantity</th>
        <th>Order Date</th>
        <th>Status</th>
        <th>Payment Method</th>
        <th>Total Amount</th>
        <th>Action</th>
       </tr>

    @foreach ($orders as $order)
        <tr>
            <td>{{$order->fullName}}</td>
            <td>{{$order->email}}</td>
            <td>{{$order->name}}</td>
            <td>{{$order->order_quantity}}</td>
            <td>{{$order->order_date}}</td>
            <td>{{$order->status}}</td>
            <td>{{$order->payment_method}}</td>
            <td>{{$order->total_amount}}</td>

            <td>
            <a href=""></a>
            
            </td>
        </tr>
    @endforeach
     </thead>
     </table>
</div>
@endsection
  
   
