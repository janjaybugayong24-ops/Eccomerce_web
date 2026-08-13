@extends("includes.extention.content")
@section('title','Create Order')
@section('content');

<h2>Order for {{$customer->fullName}}</h2>
<div>
<form method="post" action="{{route('order.store')}}">
@csrf

<input type="hidden" name="customer_id" value="{{$customer->id}}">

<table border="1">

<tr>
<th>Product</th>
<th>Price</th>
<th>Quantity</th>

</tr>

@foreach($products as $product):

<tr>

<td>{{$product->product_name}}</td>

<td>{{$product->price}}</td>

<td><input type="number" name="products[{{$product->id}}]" value="0"></td>

</tr>

@endforeach



</table>
     
 <!--
    <h4>Payment Method</h4>
    <input type="radio" name="payment_method" value="Bpi">Bpi
    <input type="radio" name="payment_method" value="Gcash">Gcash
    <input type="radio" name="payment_method" value="PayMaya">PayMaya
    <input type="radio" name="payment_method" value="Cash">Cash
    <br><br>

     <button type="submit">Order Product</button>
  -->

</form>

@endsection
