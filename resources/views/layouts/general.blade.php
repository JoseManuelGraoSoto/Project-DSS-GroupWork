<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ URL::asset('css/bst_styles.css'); }}">

    @yield('head')

    <title>Invent</title>
</head>

<body>
    <nav class="navbar sticky-top navbar-expand-lg bg-primary px-4 justify-content-between">
        <a href="{{ route('home') }}" class="d-flex align-items-center gap-3 navbar-brand">
            <i class='bx bx-pen fs-1 text-secondary'></i>
            <h1 class="fw-bold text-secondary">Invent</h1>
        </a>
        <div class="nav-item dropdown px-lg-3">
            <a class="nav-link dropdown-toggle arrow-none p-0" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="bg-accent text-secondary p-2 text-center d-lg-none rounded">Opciones</span>
                <img src="{{ URL::asset('img/default.png'); }}" class="d-none d-lg-inline rounded" width="40" height="38" alt="Default user picture">
            </a>
            <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end animate slideIn" aria-labelledby="navbarDropdownMenuLink">
                <li><a class="dropdown-item" href=" {{ route('profile') }} ">Perfil</a></li>
                @auth
                    @if(Auth::user()->type == 'author' || Auth::user()->type == 'moderator')
                    <li><a class="dropdown-item bg-accent" href=" {{ route('createArticle') }} ">Añadir artículo</a></li>
                    @endif
                    
                    @if(Auth::user()->type == 'administrator')
                    <li><a class="dropdown-item bg-accent" href=" {{ route('adminHome') }} ">Panel de administrador</a></li>
                    @endif
                @endauth
                
                <div class="dropdown-divider"></div>
                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Cerrar sesión') }}
                    </a>

                    <form id="logout-form" class="d-none" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </nav>
    @yield('body-section')
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    @yield('scripts')
</body>

</html>