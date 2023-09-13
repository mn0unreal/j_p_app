<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Job portal</title>
    <link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('assets/filepond/filepond.css') }}" rel="stylesheet">

</head>
<body>
<script src="{{ url('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ url('assets/filepond/filepond.js') }}"></script>

{{--<nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">--}}

{{--    <div class="container">--}}

{{--        <a class="navbar-brand" href="/">Tech Jobs</a>--}}

{{--{{dd(auth()->user()->user_type)}}--}}

{{--        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"--}}
{{--                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">--}}
{{--            <span class="navbar-toggler-icon"></span>--}}
{{--        </button>--}}

{{--        <div class="collapse navbar-collapse" id="navbarNav">--}}

{{--            <ul class="navbar-nav ms-auto">--}}

{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link " href="/">Home</a>--}}
{{--                </li>--}}

{{--                @if(Auth::check())--}}
{{--                --}}{{--                --}}
{{--                <li class=" nav-item dropdown">--}}

{{--                    <button class=" dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"--}}
{{--                            style="--}}
{{--                              padding-left: 0px;--}}
{{--                              padding-right: 0px;--}}
{{--                              border-top-width: 0px;--}}
{{--                              border-left-width: 0px;--}}
{{--                              border-right-width: 0px;--}}
{{--                              border-bottom-width: 0px;--}}
{{--                              padding-top: 0px;--}}
{{--                              padding-bottom: 0px;--}}
{{--                              height: 0px;--}}
{{--                            ">--}}

{{--                        <img src="{{Storage::url(auth()->user()->profile_pic ?? '')}}" width="35" class="rounded-circle" >--}}
{{--                    </button>--}}

{{--                    <ul class="dropdown-menu">--}}
{{--                        @auth--}}
{{--                            @if(auth()->user()->user_type == 'seeker')--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link active" aria-current="page" href="{{ route('seeker.profile') }}">Profile</a>--}}
{{--                                </li>--}}

{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link active" aria-current="page" href="{{ route('job.applied') }}">Job applied</a>--}}
{{--                                </li>--}}
{{--                            @elseif(auth()->user()->user_type == 'employer')--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link active" aria-current="page" href="{{ route('dashboard') }}">Dashboard</a>--}}
{{--                                </li>--}}
{{--                            @endif--}}
{{--                        @endauth--}}

{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link active" id="logout" aria-current="page" href="#">Logout</a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}


{{--                </li>--}}
{{--                --}}{{--                --}}
{{--                @endif--}}

{{--                @if(!Auth::check())--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" href="{{ route('login')}}">Login</a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" href="{{ route('create.seeker')}}">Job Seeker</a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" href="{{ route('create.employer')}}">Employer</a>--}}
{{--                    </li>--}}
{{--                @endif--}}

{{--                <form id="form-logout" action="{{ route('logout')}}" method="post">@csrf</form>--}}

{{--            </ul>--}}

{{--        </div>--}}

{{--    </div>--}}

{{--</nav>--}}


<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="/">Tech Jobs</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
        </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        @auth
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{Storage::url(auth()->user()->profile_pic ?? '')}}" width="35" class="rounded-circle" >
                {{--                <i class="fas fa-user fa-fw"></i>--}}
            </a>

            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="{{route('listing.index')}}">Jobs listing</a></li>
                @if(auth()->user()->user_type == 'seeker')
                <li><a class="dropdown-item" href="{{ route('job.applied') }}">Job applied</a></li>
                <li><a class="dropdown-item" href="{{ route('seeker.profile') }}">Profile</a></li>
                @elseif(auth()->user()->user_type == 'employer')
                <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
                @endif
                <li><hr class="dropdown-divider" /></li>
                <li>
                    <form id="form-logout" action="{{ route('logout') }}" method="post">@csrf
                        <button  class="dropdown-item"  type="submit">logout</button>
                    </form>
                </li>
            </ul>
        </li>

        @endauth
{{----}}
            @if(!Auth::check())
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('listing.index')}}">Jobs listing</a>
                </li>
            <li class="nav-item">
                    <a class="nav-link" href="{{ route('login')}}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('create.seeker')}}">Job Seeker</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('create.employer')}}">Employer</a>
                </li>
            @endif
            <form id="form-logout" action="{{ route('logout')}}" method="post">@csrf</form>
{{--        </li>--}}
    </ul>
</nav>

@yield('content')

{{--<script src="{{ url('assets/js/bootstrap.bundle.min.js') }}"></script>--}}
{{--<script src="{{ url('assets/filepond/filepond.js') }}"></script>--}}


<script>
    let logout = document.getElementById('logout');
    let form = document.getElementById('form-logout');
    logout.addEventListener('click',function (){
        form.submit();
    });
</script>


</body>
</html>
