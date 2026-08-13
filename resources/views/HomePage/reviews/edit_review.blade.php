@extends("layouts.default")
@section('title', 'edit review')
@extends('partials.navbars.customer')
@section('content')


<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <di class="card">
            <div class="card card-body">
                <h5>Your a editing a review for {{$review->product->product_name}}</h5>
                <form action="{{route('change.review', $product->slug)}}" method="post">
                     @csrf
                     @method('put')
                     <textarea class="form-control" name="edit_customer_review" rows="5" placeholder="Your new thoughts?">{{$review->customer_review}}</textarea>
                     <button type="submit" class="btn btn-primary float-end mt-3">Update Review</button>
                </form>
            </div>
        </div>
    </div>
    </div>
</div>

@endsection