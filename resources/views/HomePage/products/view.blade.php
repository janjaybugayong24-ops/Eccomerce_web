
@extends("layouts.default")
@section('title',$products->product_name)
@extends('partials.navbars.customer')
@section('content')

    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container">
            <a href="{{url('category')}}" class="text-decoration-none">
            Collections /
            </a>
            <a href="{{url('view/category/'.$products->category->slug)}}" class="text-decoration-none">
                {{$products->category->category_name}} /
        </a>
        <a href="{{url('category/'. $products->category->slug.'/'.$products->slug)}}" class="text-decoration-none">
        {{$products->product_name}}
        </a>
    </div>
    </div>

    <div class="container p-2">
    <div class="card shadow product_data">
        <div class="card-body m-5">
            <div class="row">
            <div class="col-md-4 border-right">
                <img src="{{asset('public/customer/'.$products->product_photo)}}" class="w-100" alt="Product Image">
            </div>
            <div class="col-md-8">
                <h2 class="mb-0">
                    {{$products->product_name}}
                    <label style="font-size: 16px;" class="float-end badge bg-danger trending_tag">{{$products->trending == '1' ? 'Trending':'Not trending'}}</label>
                </h2>
                <hr>
                <label class="me-3">Orginal Price: <s>Rs {{$products->price}}</s></label>
                <label class="fw-bold">Selling Price: {{$products->selling_price}}</label>
                @php $ratenum = number_format( $rating_value) @endphp
                <div class="rating">
                    @for($i = 1; $i<= $ratenum; $i++)
                    <i class="fa fa-star checked"></i>
                    @endfor
                    @for($j = $ratenum+1; $j <= 5; $j++)
                    <i class="fa fa-star"></i>
                    @endfor
                    <span>
                        @if ($rating->count() )
                        {{$rating->count()}} Ratings
                        @else
                        No Ratings
                        @endif
                    </span>
                </div>
                <p class="mt-3">
                    {{$products->description}}
                </p>
                <hr>
                @if($products->stock_quantity > 0)
                    <label class="badge bg-success">In Stock</label>
                @else
                    <label class="badge bg-danger">Out of Stock</label>
                @endif
                <div class="row mt-2">
                    <div class="col-md-3 my-auto">
                        <input type="hidden" value="{{$products->id}}" class="product_id">
                        <label class="Quantity">Quantity</label>
                        <div class="input-group text-center">
                            <button class="input-group-text decrement-btn">-</button>
                            <input type="text" name="quantity" value="1" class="form-control qty-input text-center">
                            <button class="input-group-text increment-btn">+</button>
                        </div>
                    </div>
                    <div class="col-md-9 mb-3 mt-3 ">
                        @if($products->stock_quantity > 0)
                            <button type="button" class="btn btn-primary me-3 float-start addToCartBtn">Add to Cart <i class="fa-solid fa-cart-shopping"></i></button>
                        @endif
                        <button type="button" class="btn btn-success me-3 float-start addToWishlistBtn">Add to Wishlist <i class="fa-solid fa-heart"></i></button>
                    </div>
                </div>
            </div>

            </div>
            <div class="col-md-12">
                <hr>
                <h3>Description</h3>
                    <p class="mt-3 mb-3">
                {{$products->description}}
            </p>
            </div>
            <hr>

        <div class="row">
        <div class="col-md-4">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Rate this Product
            </button>
            <a href="{{route('review.product', $products->slug )}}" class="btn btn-primary">Write a Review</a>
        </div>

        <div class="col-md-8">
        @foreach ($reviews as $review)
            <div class="user-review">
            <label for="">{{$review->customer->username }}</label>
            @if($review->customer_id == Auth::user()->id) 
              <a href="{{url('edit-review/'.$products->slug.'/user_review')}}">edit</a>  
            @endif
            <br>

            @php
            $rating = App\Models\rating\Ratings::where('product_id', $products->id)->where('customer_id', $review->customer->id)->first();
            @endphp
            @if ($rating)

            @php $customer_rated = $rating->rated_star; @endphp

                @for($i = 1; $i<= $customer_rated; $i++)
                    <i class="fa fa-star checked"></i>
                @endfor

                @for($j = $customer_rated+1; $j <= 5; $j++)
                    <i class="fa fa-star"></i>
                @endfor

                @endif
                <small>Reviewed on {{$review->created_at->format('d M Y H:i A')}} </small>,
                <small>Edited on {{$review->updated_at->format('d M Y H:i A') }}</small>
                <p>
                    {{$review->customer_review}}
                </p>
            </div>
            @endforeach

            </div>
        </div>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static">
    <div class="modal-dialog">
    <div class="modal-content">
        <form action="{{route('add.rating')}}" method="post">
            @csrf
        <input type="hidden" name="product_id" value="{{$products->id}}">
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Rate {{$products->product_name}}</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="rating-css">
                <div class="star-icon">
                @if ($customer_rating)
                    @for($i = 1; $i<= $customer_rating->rated_star; $i++)
                    <input type="radio" value="{{$i}}" name="product_rating" checked id="{{$i}}">
                    <label for="{{$i}}" class=" fa fa-star checked"></label>  
                    @endfor
                    
                    @for($j = $customer_rating->rated_star+1; $j <=5; $j++)
                    <input type="radio" value="{{$j}}" name="product_rating"  id="{{$j}}">
                    <label for="{{$j}}" class=" fa fa-star checked"></label>  
                    @endfor
                    
                @else
                    <input type="hidden" name="product_id" value="{{$products->id}}">
                    <input type="radio" value="1" name="product_rating" id="rating1">
                    <label for="rating1" class=" fa fa-star"></label>
                    <input type="radio" value="2" name="product_rating" id="rating2">
                    <label for="rating2" class=" fa fa-star"></label>
                    <input type="radio" value="3" name="product_rating" checked id="rating3">
                    <label for="rating3" class=" fa fa-star"></label>
                    <input type="radio" value="4" name="product_rating" id="rating4">
                    <label for="rating4" class="fa fa-star"></label>
                    <input type="radio" value="5" name="product_rating" id="rating5">
                    <label for="rating5" class="fa fa-star"></label>
                @endif
                </div>
                </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Rate</button>
        </form>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
</div>

@endsection


