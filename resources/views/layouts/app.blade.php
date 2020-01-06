<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/all.css') }}" rel="stylesheet">

    <style>
        .login-labels {
            font-size: 17px;
        }

        .nav-item {
            margin-bottom: 7px;
            font-size: 15px;
        }

        .header-nav {
            width: 250px;
        }

        .header-title {
            background: #1a2226;
        }

        .a {
            background-image: linear-gradient(90deg, #EAEA4C 10%, lightsalmon, lightpink 90%);
        }

        /* Sidebar config*/
        /*.wrapper {
            display: flex;
            width: 100%;
        }

        #sidebar {
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            z-index: 999;
            background: #7386D5;
            color: #fff;
            transition: all 0.3s;
        }*/

        .collapse { visibility: hidden;}
        .collapse.show {visibility: visible; display: block;}
        .collapsing {position: relative; height: 0; overflow: hidden;-webkit-transition-property: height, visibility; transition-property: height, visibility;-webkit-transition-duration: 0.01s; transition-duration: 0.01s;  -webkit-transition-timing-function: ease;  transition-timing-function: ease;}
        .collapsing.width {  -webkit-transition-property: width, visibility;  transition-property: width, visibility;  width: 0;  height: auto;}


        @yield('css')
    </style>
</head>
<body>
<div id="app">
    <!-- Start Header -->
    <nav class="navbar navbar-expand-md navbar-dark shadow p-0 a fixed-top" style="height: 50px;">

        <a class="navbar-brand header-nav mr-0 text-center text-black-50" href="{{ url('/') }}"
           style="background-color: #EAEA4C; height: 100%; text-decoration-line: underline; font-size: 25px">
            {{ strtoupper( config('app.name', 'Laravel')) }}
        </a>

        <button class="btn btn-toolbar" type="button" data-toggle="collapse" data-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation" id="collapseBtn">
            <span class="fas fa-bars"></span>
        </button>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                   {{-- <li class="nav-item mr-1">
                        <a class="nav-link text-black-50 login-labels"
                           href="{{ route('login') }}">{{ __('messages.login_access') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item mr-3">
                            <a class="nav-link text-black-50 login-labels"
                               href="{{ route('register') }}">{{ __('messages.register') }}</a>
                        </li>
                    @endif--}}
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle login-labels text-black-50" href="#"
                           role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item login-labels text-black-50 mr-2" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>
    <!-- End Header-->

    <!-- Start Content Block-->
    <main class="container-fluid mt-5">

        <div class="row">
            <div class="col-12">
                @if(Auth::check())
                    <div class="col-4 float-right">
                        @include('layouts.flash')
                    </div>
                @else
                    <div class="col-4 float-right mt-4">
                        @include('layouts.flash')
                    </div>
                @endif
            </div>

            <div class="col-12">
                @if(Auth::check())
                    <div class="row">

                        @include('layouts.sidebar')

                        <div id="contentBody" class="col-9 pt-4">
                            @yield('content')
                        </div>
                    </div>
                @else
                    <div class="pt-4">
                        @yield('content')
                    </div>
                @endif
            </div>
        </div>
    </main>
    <!-- End Content Block-->
</div>

@yield('js')
<script>
    $('#collapseBtn').on('click', function () {
        if ($('#sidebarCollapse').hasClass('show')){
            $('#contentBody').removeClass('col-9').addClass('col-12');
        }else {
            $('#contentBody').removeClass('col-12').addClass('col-9');
        }
    });

    if(! $('#sidebarCollapse').hasClass('show')){
        $('#contentBody').removeClass('col-9').addClass('col-12');
    }
</script>
</body>
</html>
