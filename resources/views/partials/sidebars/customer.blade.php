
@auth

 <input class="input" type="checkbox" id="close">
 <div class="overlay"></div>
    <label for="close" class="btn-show-nav">
        <i class="fas fa-bars"></i>
    </label> 
    
    <nav class="nav-side">
        
           <label for="close" class="btn-hide-nav">
               <i class="fas fa-times"></i>
           </label>
         
         <a class="nav_title" href="">Customer Information</a>
            <img src="{{asset('public/customer/'.Auth::user()->photo)}}" alt="Avatar" class="img-avatar">
             <li><p class="welcome"> Account: {{Auth::user()->username}}</p></li><br>

         <h2>Your Actions</h2>

        <ul>bhggjhghhj

        <li class="{{Request::routeIs('customer.dashbord') ? 'active':''}}">
        
            <a href="{{ route('customer.dashbord') }}">

                <i class="fa-solid fa-house"></i>
                <span>Dashbord</span>
            </a>

        </li>


        <li class="{{Request::routeIs('customer.edit') ? 'active':''}}">
            
        <a href="{{route('customer.edit', Auth::user()->id)}}">
            <i class="fa-solid fa-circle-info"></i>
             <span>Edit Your Information</span>
        </a>

        </li>
       
        <li class="{{Request::routeIs('address.info') ? 'active':''}}">

            <a href="{{ route('address.info', Auth::user()->id) }}">
            <i class="fa-solid fa-address-book"></i>
                <span>View Customers</span>
            </a>
        </li>
        
        
        <li >
          <form action="{{route('logout')}}" method="post" class="m-0">
            @csrf
            <button class="btn btn-logout">Logout</button>
        </form>

        </li>

        </ul>

    </nav>
 @endauth
