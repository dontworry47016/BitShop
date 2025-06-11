<nav class="navbar navbar-expand-md">
    <div class="container-fluid">
        <ul class="navbar-nav me-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route("home") }}"><img src="/svg/logo.svg" width="60" height="60" loading="lazy" class="d-inline-block align-top" alt="{{ config('app.name') }}"></a>
            </li>
        </ul>
        <div class="me-auto row justify-content-center">
                         <div class="col-md-auto">
                            <form action="{{route('search')}}" method="POST" class="form-inline h-100">
                            {{csrf_field()}}
                                <div class="input-group w-100">
                                <input type="text" class="form-control form-control" id="search" name="search" placeholder="Type here to search..." value="{{app('request')->input('query')}}">
                                     <div class="input-group-append">
                                         <button class="btn  btn-primary">Go</button>
                                     </div>
                                 </div>
                              </form>
                            </div>
                          </div>
    </div>

    <div class="container-fluid">
        <ul class="navbar-nav ms-auto">
            @admin
                        <li class="nav-item @isroute('admin') active @endisroute">
                            <a class="nav-link" href="{{ route('admin.index') }}"><i class="fas fa-user-tie mr-2"></i></a>
                        </li>
                        @endadmin
                        @moderator
                        <li class="nav-item @isroute('admin') active @endisroute">
                            <a class="nav-link" href="{{ route('admin.index') }}"><i class="fas fa-user-tie mr-2"></i></a>
                        </li>
                        @endmoderator
                        @auth
                        <li class="nav-item @isroute('profile.tickets') active @endisroute">
                            <a class="nav-link" href="{{ route('profile.tickets') }}"><i class="fas fa-hand-holding-medical mr-2"></i></a>
                        </li>

                        <li class="nav-item @isroute('profile.notifications') active @endisroute">
                            <a href="{{route('profile.notifications')}}" class="nav-link">
                                <span @if(auth()->user()->unreadNotifications()->count() > 0) class="text-warning" @endif><i class="fa fa-bell"></i> {{auth()->user()->unreadNotifications()->count()}}</span>
                            </a>
                        </li>
                        @if(auth() -> user() -> isVendor())
                        <li class="nav-item @isroute('profile.sales') active @endisroute">
                            <a href="{{route('profile.sales')}}" class="nav-link">
                                <span @if(auth() -> user() -> vendor -> unreadSales() > 0) class="text-warning" @endif><i class="fa fa-money-bill"></i> {{ auth() -> user() -> vendor -> unreadSales() }}</span>
                            </a>
                        </li>
                        @else
                           @if(auth() -> user() -> isAdmin())
                           @else
                           <li class="nav-item text-center @isroute('profile.cart') active @endisroute">
                               <a class="nav-link" href="{{ route('profile.cart') }}">
                                   <i class="fas fa-shopping-cart mr-2"></i>
                                   {{ session('cart_items') !== null ? count(session('cart_items')) : 0 }}
                               </a>
                           </li>
                           @endif
                        @endif
                       
                        <li class="nav-item @isroute('profile.index') active @endisroute">
                            <a class="nav-link" href="{{ route('profile.index') }}">
                            {{auth()->user()->username}} <img class="image rounded-circle" src="{{asset('/storage/images/'.Auth::user()->image)}}" alt="" style="width: 25px; height: 25px; padding: 0px; margin: 0px; ">
                            </a>
                        </li>

                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('auth.signin')}}">Sign In</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('auth.signup')}}">Sign Up</a>
                        </li>
                    @endauth
                </ul>
    </div>
</nav>

