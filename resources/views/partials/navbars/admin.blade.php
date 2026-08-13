
<nav class="navbar navbar-expand-lg  bg-light p-3 mb-2">

  <div class="container-fluid">

    <a class="navbar-brand" href="#">E-Shopping</a>
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      
      @guest('admins')
        
      <ul class="navbar-nav ms-auto">

        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Admin</a>
        </li>

        <li class="nav-item"><a class="nav-link active"  href="{{route('admin.login')}}">Login</a></li>
    
      </ul>
      
      @endguest
       
      @auth('admins')
       <ul class="navbar-nav ms-auto">

        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{route('admin.dashbord')}}">Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{route('admin_show.orders')}}">Orders</a>
        </li>

        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{route('customer.view')}}">Customers</a>
        </li>

   
    <li class="nav-item dropdown ">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        {{  Auth::guard('admins')->user()->adminname }}
    </a>

    <ul class="dropdown-menu dropdown-menu-end">
         
        <li>
          <a class="dropdown-item" href="{{route('categories.show')}}">Categories</a>
        </li>

        <li>
          <a class="dropdown-item" href="{{route('brands.create')}}">Create Brands</a>
        </li>

         <li>
          <a class="dropdown-item" href="{{route('brands.show')}}">Brands</a>
        </li>
        
        <li>
          <a class="dropdown-item" href="{{route('product.index')}}">Products</a>
        </li>

        <li>
          <a class="dropdown-item" href="{{route('product.create')}}">Create Products</a>
        </li>

        <li>
            <form action="{{ route('admin.logout') }}" method="post" class="m-0">
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



