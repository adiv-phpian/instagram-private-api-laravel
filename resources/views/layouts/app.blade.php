<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    <style>

    .boxes{
      margin: 0 auto;
    }

    .box{
      margin: 15px 15px;
      display: inline;
      padding: 10px;
      border: 1px solid #d0d0d0;
      color: white;
      background: #0074D9;
    }

    .box .number{
      color: white;
      font-weight: bold;
      font-size: 20px;
    }
    </style>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/home') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('alogin') }}">Login</a></li>
                            <!--<li><a href="{{ route('register') }}">Register</a></li> -->
                        @else
                            <li>
                              <a href="/users" >Users</a>
                            </li>
                            <li>
                              <a href="/proxies" >Proxies</a>
                            </li>

                            <li><a href="{{ route('alogout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                Logout
                            </a></li>

                            <!--<li>
                              <a href="/settings" class="dropdown-toggle" >Settings</a>
                            </li> -->
                            <li class="dropdown">
                                <!--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a> -->

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('alogout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('alogout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->


    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
</body>

@yield('script')
</html>
