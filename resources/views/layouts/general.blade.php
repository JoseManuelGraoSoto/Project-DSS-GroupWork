<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ URL::asset('css/bst_styles.css'); }}">
    <title>Invent</title>
</head>

<body>
    <nav class="navbar sticky-top navbar-expand-lg bg-primary px-5">
        <a href="#" class="d-flex align-items-center gap-3 navbar-brand">
            <i class='bx bx-pen fs-1'></i>
            <h1 class="fw-bold">Invent</h1>
        </a>

        <button class="navbar-toggler bg-terciary" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse text-center justify-content-right align-content-sm-right" id="navbarSupportedContent">
            <ul class="navbar-nav gap-lg-5 gap-3 pb-3 pb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle arrow-none p-0" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <h3 class="bg-accent text-secondary py-1 text-center d-lg-none fs-5 rounded">Perfil</h3>
                        <img src="{{ URL::asset('img/default.png'); }}" class="d-none d-lg-inline rounded" width="40" height="38" alt="Default user picture">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end animate slideIn" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <div class="dropdown-divider"></div>
                        @auth
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" class="d-none" action="{{ route('logout') }}" method="POST">
                                @csrf
                            </form>
                        </li>
                        @endauth
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    @yield('body-section')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>