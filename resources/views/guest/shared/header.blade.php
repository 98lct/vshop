
<header class="line" style="height: 75px;">
    <div class="container">
        
        <div class="row">
            <div class="col-4 col-sm-4 col-md-6 col-lg-8 col-xl-8">
            	<a href="{{url('/')}}"><img src="{{asset('img/logo.png')}}" height="50px" style="height: 75px;width: 150px;"></a>
            </div>
            <div class="col-8 col-sm-8 col-md-6 col-lg-4 col-xl-4 text-right" id="header-user">
            	<i class="fas fa-user d-none d-sm-none d-md-none d-lg-inline d-xl-inline"></i>
            	<span class="d-inline d-print-block d-sm-inline d-md-inline d-lg-inline d-xl-inline">
                    @if(Auth::check())
                        {{ Auth::user()->name }}
                        <a class="btn btn-sm btn-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        {{ __('Đăng Xuất') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    @else
                        <a href="{{route('login')}}">Đăng Nhập</a>
                        <i class="fas fa-user-plus d-none d-sm-none d-md-none d-lg-inline d-xl-inline"></i>
                        <a href="{{route('register')}}">Đăng Ký</a>   
                
                    @endif
                </span>
            	<span>&nbsp;|| &nbsp;</span>
            	
                <span class="d-inline d-sm-inline d-md-inline d-lg-inline d-xl-inline">
                    
                </span>
                <a class="btn btn-primary d-inline" href="{{route('IndexCart')}}" id="btn-shopcard"><i class="fa fa-shopping-bag d-none d-sm-none d-md-none d-lg-inline d-xl-inline"></i><span>&nbsp; 
                    {{Cart::count()}} SP</span></a>
            </div>
        </div>
    </div>   
</header>