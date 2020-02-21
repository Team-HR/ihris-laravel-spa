<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <style type="text/css">
    @font-face {
        font-family: Abel;
        src: url('{{ asset('fonts/Abel-Regular.ttf') }}');
    }
    </style>
    <!-- Styles -->

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    
    <link href="{{ asset('css/fontawesome-free-5.12.0-web/css/all.min.css') }}" rel="stylesheet">

        <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    {{-- <script src="{{ asset('js/jquery-3.4.1.slim.min.js') }}"></script> --}}
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>

</head>

<body style="
    background: url({{asset('images/circuitboardbg.gif')}}) repeat center center fixed;
    -moz-background-size: cover;
    -webkit-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
">

<div class="wrapper">
        {{-- Sidebar Start --}}
        <nav id="sidebar" class="card" style="background: none !important;">
            <a href="{{url('/')}}" class="sidebar-header text-center p-3 m-0 card-header">
                <img src="{{ asset('favicon.ico') }}" width="35" height="35">
                {{-- <cite class="name-tag-show">iHRIS</cite> --}}
                <strong class="name-tag font-italic">Integrated HRIS</strong>
            </a>

    <div class="list-group">
      <a href="{{url('/')}}" class="list-group-item list-group-item-action"> 
            <i class="fas fa-home"></i>     
            <span class="link-label">Home</span>
      </a>
      <a href="{{url('/cores')}}" class="list-group-item list-group-item-action"> 
            <i class="fas fa-atom"></i>     
            <span class="link-label">Cores</span>
      </a>

        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="list-group-item list-group-item-action dropdown-toggle">
                        <i class="fas fa-id-card"></i> 
                        <span class="link-label">PIM</span>
        </a>
        <div class="collapse list-group" id="homeSubmenu">
                <a class="list-group-item list-group-item-action" href="">
                    <strong>PDS</strong> 
                    <span class="link-label blockquote-footer">Personal Data Sheet</span>
                </a>
        </div>

        <a href="{{url('/')}}" class="list-group-item list-group-item-action"> 
            <i class="fas fa-user-tie"></i> <span class="link-label">Competency</span>
        </a>
        <a href="{{url('/employee')}}" class="list-group-item list-group-item-action"> 
            <i class="fas fa-users"></i> <span class="link-label">Employee List</span>
        </a>
        <a href="#plantillaSubmenu" data-toggle="collapse" aria-expanded="false" class="list-group-item list-group-item-action dropdown-toggle">
                        <i class="fas fa-file-excel"></i>
                        <span class="link-label">Plantilla</span>
        </a>
        <div class="collapse list-group" id="plantillaSubmenu">
                <a class="list-group-item list-group-item-action" href="{{url('/casual/plantilla')}}">
                    <strong>Cas</strong> 
                    <span class="link-label blockquote-footer">Casual Plantilla</span>
                </a>
                <a class="list-group-item list-group-item-action" href="{{url('/employee')}}">
                    <strong>Perm</strong> 
                    <span class="link-label blockquote-footer">Permanent Plantilla</span>
                </a>
        </div>

    </div>

        </nav>
        {{-- Sidebar End --}}


        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg p-1 m-1 mt-3">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-light mr-4">
                        <i class="fas fa-bars"></i> 
                    </button> 
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle btn btn-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fas fa-user-circle mr-2"></i>
                                    <span class="mr-5">{{Auth::user()->name}}</span>
                                    <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
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
                </div>

            </nav>
        <main>
            @yield('content')
        </main>

        </div>
    </div>
</body>

@yield('page-script')
<script type="text/javascript">
          $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
</script>

</html>
