<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <h1 class="text-center">NBA Lineup Builder</h1>
    <title>@yield('title')</title>
</head>
<body>
    <div class="container mt-3 mb-3">
        <div class="row">
            <div class="col-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('about')}}">About</a>                  
                    </li>
                    
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