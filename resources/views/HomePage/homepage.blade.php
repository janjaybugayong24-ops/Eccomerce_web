@extends("layouts.default")
@section('title','home')
@section('content')
@include('partials.navbars.customer')

  <div id="carouselExampleDark" class="carousel carousel-dark slide">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="10000">
      <img src="{{asset('public/customer/slider_shop.png')}}" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>First slide label</h5>
        <p>Some representative placeholder content for the first slide.</p>
      </div>
    </div>
    <div class="carousel-item" data-bs-interval="2000">
       <img src="{{asset('public/customer/slider_shop.png')}}" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Second slide label</h5>
        <p>Some representative placeholder content for the second slide.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="{{asset('public/customer/slider_shop.png')}}" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Third slide label</h5>
        <p>Some representative placeholder content for the third slide.</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>

  </button>

</div>
<br><br>

 <div class="py-5">
    <div class="container">
        <div class="row">
          <h4 >Featured Products</h4>
          <div class="owl-carousel owl-theme">
        @foreach($featured_product as $products)
         <a href="{{url('category/'.$products->category->slug. '/' .$products->slug)}}" class="text-decoration-none">
        <div class="item">
         <div class="card">
            <img src="{{asset('public/customer/'.$products->product_photo)}}" alt="Product Image">
            <div class="card-body">
            <h5>{{$products->product_name}}</h5>
            <small class="float-end">{{$products->selling_price}}</small>
            <small class="float-start"><s>{{$products->price}}</s></small>
          </div>
         </div>
         </div>
         </a>
        @endforeach
          </div>
        </div>
    </div>
 </div>

 <div class="py-5">
    <div class="container">
        <div class="row">
          <h4 >Trending categories</h4>
          <div class="owl-carousel owl-theme">
        @foreach($popular_categories as $category)
         <a href="{{route('view.category', $category->slug)}}" class="text-decoration-none">
        <div class="item">
         <div class="card">
           <img src="{{asset('public/customer/'.$category->category_photo)}}" alt="Product Image">
            <div class="card-body">
            <h5>{{$category->category_name}}</h5>
             <p>{{$category->description}}</p>
          </div>
         </div>
         </div>
         </a>
        @endforeach
          </div>
        </div>
    </div>
 </div>


@endsection

@section('scripts')
 <script>
        $('.owl-carousel').owlCarousel({
           loop:true,
           margin:10,
           nav:false,
           dots:true,
           autoplay:true,
          responsive:{
             0:{
            items:1
           },
          600:{
            items:3
             },
            1000:{
            items:5
           }
       }
      })
     </script>
     
@endsection
  
