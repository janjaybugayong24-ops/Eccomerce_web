@extends("layouts.default")
@section('title', 'write a review')
@extends('partials.navbars.customer')
@section('content')

<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <di class="card">
            <div class="card card-body">
                @if($verified_purchase->count() >0)
                <h5>Hey {{Auth::user()->username}} write a review for product {{$product->product_name}}</h5>
                <form action="{{route('add.review')}}" method="post">
                     @csrf
                     <input type="hidden" name="product_id" value="{{$product->id}}">
                     <textarea class="form-control" name="customer_review" rows="5" placeholder="Your thoughts?"></textarea>
                     <button type="submit" class="btn btn-primary float-end mt-3">Submit Review</button>
                </form>
                @else
                <div class="alert alert-danger">
                    <h5>Your not eligible to review a product</h5>
                    <p>
                        For truthworthness of the reviews, only customers who already purchased the 
                        product can share there reviews about products.
                    </p>
                    <a href="{{url('/')}}" class="btn btn-primary">Go to Home page</a>
                </div>
                @endif
            </div>
        </div>
    </div>
    </div>
</div>

@endsection