@extends("layouts.default")
@section('title','home')
@extends('partials.navbars.customer')
@section('content')

 <div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mb-5">All Categories</h2>
                  <div class="owl-carousel owl-theme">
                @foreach($category as $categories)
                        <div class="item">
                        <div class="card">
                        <a href="{{route('view.category', $categories->slug)}}" class="text-decoration-none">
                        <img src="{{asset('public/customer/'.$categories->category_photo)}}" alt="Product Image">
                        <div class="card-body">
                        <h5>{{$categories->category_name}}</h5>
                        <small>{{$categories->description}}</small>
                     </div>
                    </div>
                    </div>
                    </a>
                @endforeach
            </div>
            </div>
        </div>
    </div>
 </div>

@endsection

@section('scripts')
 <script>
        $('.owl-carousel').owlCarousel({
           loop:true,
           nav:false,
           dots:true,
           autoplay:true,
          responsive:{
             0:{
            items:3
           },
          600:{
            items:3
             },
            1000:{
            items:3
           }
       }
      })
     </script>
     @endsection
  