<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Invent</title>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('css/bst_styles.css'); }}">
</head>

<body>
    <div class="container-fluid my-5">
        <div class="row d-flex justify-content-center align-items-center h-100">
            @yield('illustration')
            <div class="card col-10 col-md-8 col-lg-6 col-xl-4 offset-lg-1 shadow">
                @if(Route::is('login'))          
                <h1 class="display-4 my-4 text-center">Iniciar sesión</h1>
                
                <ul class="nav nav-pills nav-justified mb-3 gap-3" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="tab-login" data-mdb-toggle="pill" href="{{ route('login') }}" role="tab" aria-controls="pills-login" aria-selected="true">Iniciar sesión</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link inactive" id="tab-register" data-mdb-toggle="pill" href="{{ route('register') }}" role="tab" aria-controls="pills-register" aria-selected="false">Registrarse</a>
                    </li>
                </ul>
                @elseif(Route::is('register') )
                <h1 class="display-4 my-4 text-center">Registrarse</h1>
                <ul class="nav nav-pills nav-justified mb-3 gap-3" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link inactive" id="tab-login" data-mdb-toggle="pill" href="{{ route('login') }}" role="tab" aria-controls="pills-login" aria-selected="true">Iniciar sesión</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="tab-register" data-mdb-toggle="pill" href="{{ route('register') }}" role="tab" aria-controls="pills-register" aria-selected="false">Registrarse</a>
                    </li>
                </ul>
                @endif
                
                @yield('content')
            </div>
        </div>
    </div>
</body>

</html>