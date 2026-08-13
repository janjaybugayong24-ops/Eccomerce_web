
<nav class="navbar navbar-expand-lg  bg-light p-3 mb-2">

  <div class="container-fluid">

  <a class="navbar-brand" href="#">E-Shopping</a>

  <div class="search-bar">
    
    <form action="{{route('search.product')}}" method="post">
      @csrf
   <div class="input-group mt-2">
     <input type="search" class="form-control" name="product_name" id="search_product" required placeholder="Product" aria-label="Product" aria-describedby="basic-addon1">
     <button type="submit" class="input-group-text"><i class=" fa fa-search"></i></button>
    </div>
    </form>
   </div>
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      
       @guest
        
      <ul class="navbar-nav ms-auto">

        <li  class="nav-item"><a class="nav-link active" href="{{route('show.register')}}">register</a></li>

        <li class="nav-item"><a class="nav-link active"  href="{{route('show.login')}}">Login</a></li>

        <li class="nav-item">
          <a class="nav-link" href="{{route('show.category')}}">Category</a>
        </li>

      </ul>
      
      @endguest
       
      @auth
       <ul class="navbar-nav ms-auto">

        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{url('/')}}">Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{route('show.category')}}">Category</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{route('show.orders')}}">Orders</a>
        </li>


   <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        {{ Auth::user()->username }}
    </a>

    <ul class="dropdown-menu dropdown-menu-end">
        <li>
            <a class="dropdown-item" href="{{ route('address.info', Auth::user()->id) }}">
                Address
            </a>
        </li>

        <li>
            <a class="dropdown-item" href="{{ route('show.cart') }}">
                Cart
                <span class="badge badge-pill bg-primary cart-count">0</span>
            </a>
        </li>

         <li>
            <a class="dropdown-item" href="{{ route('wishlist') }}">
                Wishlist
                <span class="badge badge-pill bg-success wishlist-count">0</span>
            </a>
        </li>

         <li>


        </li>

        <li>
            <form action="{{ route('logout') }}" method="post" class="m-0">
                @csrf
                <button type="submit" class="dropdown-item">
                    Logout
                </button>
            </form>
        </li>
    </ul>
</li>

  </ul>

      @endauth

    </div>

  </div>

</nav>








