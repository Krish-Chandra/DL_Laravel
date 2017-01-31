<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel Quickstart - Basic</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.6/simplex/bootstrap.min.css" rel="stylesheet" type="text/css"> 
    <!-- <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.simplex.min.css')}}"/>     -->

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-alpha1/jquery.min.js"></script> -->
<!--     <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
 -->
      <script>

      </script>
    <style>
        body {
            padding-top: 70px;
            padding-bottom: 30px;
            background-color: beige;
        }

        .navbar-brand {
            padding: 0px 15px;
        }

        .container {
            width: 95%;
            padding-left: 10px;
        }
    </style>

    <script>
    </script>
</head>

<body>
    <div class="row">
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <a class="navbar-brand" href="{{URL::to('/')}}">
                        <img style="float:left;height:30px;"  alt="Library" src="{{URL::to('/')}}/images/library-icon.png" />Digital Library

                    </a>
                </div>

                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <ul class="nav navbar-nav">                        
                            @foreach( Auth::user()->roles()->get() as $role )
                                @foreach( $role->perms as $perm )
                                        <li><a href="{{ url('/admin/'.$perm->name)}}">{{ucfirst($perm->name)}}</a></li>
                                @endforeach
                            @endforeach
                        </ul>
                        <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-right">

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
                    
                </div>
            </div>
        </nav>
    </div>
    <div class="container">
        @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
        @elseif(Session::has('failure'))
        <div class="alert alert-warning">
            {{ Session::get('failure') }}
        </div>

        @endif

        @yield('content')
    </div>
    @yield('scripts')
</body>
</html>
 