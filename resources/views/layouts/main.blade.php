<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <img height="60" style="margin-bottom: 20px; margin-left: 20px; display: inline;" src="{{ URL::to('/img/logo.jpg') }}">
    <h1 style="display: inline-block; margin-left:30px; margin-top:30px;" >NBA Lineup Builder</h1>
    <title>@yield('title')</title>
</head>
<body>
    <div class="container mt-3 mb-3">
        <div class="row">
            <div class="col-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('lineups.home')}}">Home</a>                     
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('about')}}">About</a>                     
                    </li>
                    <li class="nav-item"> 
                        <a class="nav-link" href="{{route('lineups.index')}}">Lineups</a>               
                    </li>
                    @if (Auth::check())
                    <li class="nav-item">
                        <form method="post" action="{{ route('auth.logout') }}">
                             @csrf
                            <button type="submit" class="btn btn-link">Logout</button>
                        </form>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('auth.registerForm')}}">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('auth.loginForm')}}">Login</a>
                    </li>
                    @endif
                </ul>
            </div>
            <div class="col-9">
                <header>
                    <h2>@yield('title')</h2>
                </header>
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <main>
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                          {{ session('success') }}
                         </div>
                    @endif
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
</body>
</html>