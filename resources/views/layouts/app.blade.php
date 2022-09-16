<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Restaurants</title>

    <!-- Scripts -->
    <script src="{{asset('/js/html2canvas.js')}}"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!--libraries for firebase started-->
        <script src='https://cdn.firebase.com/js/client/2.2.1/firebase.js'></script>
        <script src="https://www.gstatic.com/firebasejs/4.5.0/firebase.js"></script>
        <!--libraries for firebase ended-->
        <title>{{isset($title)? $title: config('app.name')}}</title>
        <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css" integrity="sha384-vus3nQHTD+5mpDiZ4rkEPlnkcyTP+49BhJ4wJeJunw06ZAp+wzzeBPUXr42fi8If" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app" style="direction: rtl;" >


        <nav class="navbar navbar-expand-md navbar-light bg-brown shadow-sm" style="padding: 20px;" >
        @if (!auth()->user())
            <div>
            <h3 class="text-center text-white" >تسجيل الدخول</h3>
            </div>
        @endif
        @if (auth()->user())

                        <div class="row" >

                        <div class="d-flex" >
                               <div id="btnOpenMenusMobile" >
                               <i class="fa fa-bars" >
                                </i>
                               </div>
                                <div>
                                    <h4  class="on-margin text-white" >
                                                {{ Auth::user()->name }}
</h4>
                                    <label for="" class="user-email on-margin" >
                                    {{ Auth::user()->email }}
                                    </label>
                                </div>
                        </div>

                        </div>
                        @endif

            <div class="container" style="direction: rtl;" id="navbarSupportedContent" >

                <div class="" >
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto" style="margin:0px !important" >
                        <!-- Authentication Links -->
                        @guest

                        @else
                              <li class="nav-item px-2 py-2">
                              <a class="form-control mx-2 text-center nav-link-click" href="/restaurant">
                                    مطعم
                                    </a>
                                </li>
                                <li class="nav-item px-2 py-2">
                                <a class="form-control mx-2 text-center nav-link-click"  href="/links" >
                                        الروابط
                                    </a>
                                </li>
                                <li class="nav-item py-2">
                                <a class="form-control mx-2 text-center nav-link-click"  href="/qr" >
                                ريال قطري
                                </a>                                </li>



                        @endguest
                    </ul>
                </div>


            </div>

            @if (auth()->user())

            <div class="d-flex" >
                <div class="px-2 py-2" >
                    <a class="btn btn-danger" href="/change-password">
                    إعدادات

                    </a>
                </div>
                <div class="px-2 py-2" >
                      <a class="btn btn-primary" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                </div>
            </div>
            @endif
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>

<script>
    $(document).ready(function(){
        $("#btnOpenMenusMobile .fa-bars").on('click',function(){
            $("#navbarSupportedContent").toggle();
        })
    })
</script>
