<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ URL::asset('css/bst_styles.css'); }}">
    <link rel="stylesheet" href="{{ URL::asset('css/landingpage.css'); }}">
    <title>Invent</title>
</head>

<body>

    <nav id="navbar" class="navbar fixed-top navbar-expand bg-none py-3 navbar-hide-on-scroll">
        <ul class="navbar-nav gap-lg-5 gap-2  ps-3 w-100 h-100 justify-content-start justify-content-md-center align-items-center">
            <li class="nav-item"><a class="nav-link init active" href="#init">Inicio</a></li>
            <li class="nav-item"><a class="nav-link articles" href="#articles">Articulos</a></li>
            <li class="nav-item"><a class="nav-link scores" href="#scores">Ranking</a></li>
        </ul>

        @guest
        <a href="#access" class="btn small btn-primary top-right-btn">Acceso</a>
        @else
        <div class="profile">
            <a class="nav-link dropdown-toggle arrow-none p-0" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="bg-accent text-secondary p-2 text-center d-lg-none rounded">Opciones</span>
                <img src="{{ URL::asset('img/default.png'); }}" class="d-none d-lg-inline rounded" width="40" height="38" alt="Default user picture">
            </a>
            <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end dropdown-menu-lg-start animate slideIn" aria-labelledby="navbarDropdownMenuLink">
                <li><a class="dropdown-item" href=" {{ route('profile') }} ">Perfil</a></li>
                @if(Auth::user()->type == 'author' || Auth::user()->type == 'moderator')
                <li><a class="dropdown-item bg-accent" href=" {{ route('home') }} ">Añadir artículo</a></li>
                @endif
                @if(Auth::user()->type == 'administrator')
                <li><a class="dropdown-item bg-accent" href=" {{ route('adminHome') }} ">Panel de administrador</a></li>
                @endif
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
        <a href="{{ route('library') }}" class="btn small btn-primary top-right-btn">biblioteca</a>
        @endguest
    </nav>

    <section id="init" class="p-0">
        <div class="bg-terciary vh-100 p-0 d-flex flex-column align-items-center justify-content-center">
            <div class="row">
                <div class="col-10 d-flex flex-column logo">
                    <svg class="icon" style="min-height: 300px; min-width: 260px;">
                        <path stroke="white" fill="none" class="is-active" d="M 220.848 35.976 c -9.084 -9.048 -24.924 -9.012 -33.936 0.06 l -21.408 21.492 L 139.032 84 H 84 a 11.976 11.976 90 0 0 -11.268 7.896 l -48 132 c -1.596 4.38 -0.504 9.288 2.784 12.588 l 24 24 a 11.964 11.964 90 0 0 12.588 2.784 l 132 -48 A 11.976 11.976 90 0 0 204 204 v -55.032 l 26.484 -26.484 v -0.012 h 0.012 L 252 100.908 c 4.536 -4.536 7.032 -10.572 7.02 -16.98 c 0 -6.42 -2.508 -12.456 -7.056 -16.98 l -31.116 -30.972 z m -37.332 99.54 A 11.952 11.952 90 0 0 180 144 v 51.6 l -110.988 40.356 l 56.052 -56.052 c 0.312 0.012 0.624 0.096 0.936 0.096 A 18 18 90 1 0 108 162 c 0 0.312 0.084 0.624 0.096 0.936 l -56.052 56.052 L 92.4 108 H 144 c 3.192 0 6.24 -1.26 8.484 -3.516 L 174 82.968 L 205.032 114 l -21.516 21.516 z m 38.472 -38.496 l -31.032 -31.032 l 12.948 -13.008 l 31.116 30.972 l -13.032 13.068 z" />
                    </svg>
                    <svg class="text" style="min-width: 450px;">
                        <text fill="none" stroke="white" transform="translate(0 102)" stroke-width="3" font-size="102" font-family="Montserrat-Black, Montserrat" font-weight="800" letter-spacing="0.1em" class="is-active">
                            <tspan>INVENT</tspan>
                        </text>
                    </svg>
                </div>
            </div>


            <a href="#articles" class="arrow">
                <span></span>
                <span></span>
                <span></span>
            </a>
        </div>
    </section>

    <!-- ======= Articles section ======= -->
    <section id="articles" class="mt-5 py-5">
        <div class="container py-4">
            <div class="section-title">
                <span>Articulos</span>
                <h2>Articulos</h2>
                <p>Una serie de articulos mensuales disponibles al público general.</p>
            </div>
            @foreach($articles as $article)
            <article class="postcard dark blue">
                <a class="postcard__img_link" href="#">
                    <img class="postcard__img" src="{{ URL::asset('img/paper.png'); }}" alt="{{$article->title}}" />
                </a>
                <div class="postcard__text">
                    <h1 class="postcard__title blue ps-1"><a href="#">{{$article->title}}</a></h1>
                    <div class="postcard__subtitle small">
                        <time datetime="{{ date('d/m/Y', strtotime($article->created_at)) }}" class="d-flex align-items-center gap-2">
                            <i class='bx bx-calendar-alt fs-5'></i>
                            {{ date('d/m/Y', strtotime($article->created_at)) }}
                        </time>
                    </div>
                    <div class="postcard__bar"></div>
                    <div class="postcard__preview-txt">{{$article->content}}</div>
                    <div class="d-flex justify-content-between">
                        <ul class="list-inline small">
                            @for($i = 0; $i < $article->value; $i++)
                                <li class="list-inline-item m-0"><i class='bx bxs-star'></i></li>
                                @endfor

                                @if(($article->value*10)%10 != 0)
                                <li class="list-inline-item m-0"><i class='bx bxs-star-half'></i></li>
                                @endif

                                @for($i = 0; $i < (10-$article->value); $i++)
                                    <li class="list-inline-item m-0"><i class='bx bx-star'></i></li>
                                    @endfor
                        </ul>
                        <span>{{ $article->name }}</span>
                    </div>
                </div>
            </article>
            @endforeach
        </div>
    </section><!-- End Articles -->

    @guest
    <!-- ======= Access section ======= -->
    <div id="access" class="cutout">
        <div class="container access-container">
            <div class="section-title">
                <div class="d-lg-inline d-none">
                    <span>Obten acceso ilimitado</span>
                    <h2>Obten acceso ilimitado</h2>
                </div>
            </div>
            <div class="d-flex gap-5 justify-content-center align-items-center">
                <svg class="icon" style="min-height: 300px; min-width: 260px;">
                    <path stroke="white" fill="none" class="is-active" d="M 220.848 35.976 c -9.084 -9.048 -24.924 -9.012 -33.936 0.06 l -21.408 21.492 L 139.032 84 H 84 a 11.976 11.976 90 0 0 -11.268 7.896 l -48 132 c -1.596 4.38 -0.504 9.288 2.784 12.588 l 24 24 a 11.964 11.964 90 0 0 12.588 2.784 l 132 -48 A 11.976 11.976 90 0 0 204 204 v -55.032 l 26.484 -26.484 v -0.012 h 0.012 L 252 100.908 c 4.536 -4.536 7.032 -10.572 7.02 -16.98 c 0 -6.42 -2.508 -12.456 -7.056 -16.98 l -31.116 -30.972 z m -37.332 99.54 A 11.952 11.952 90 0 0 180 144 v 51.6 l -110.988 40.356 l 56.052 -56.052 c 0.312 0.012 0.624 0.096 0.936 0.096 A 18 18 90 1 0 108 162 c 0 0.312 0.084 0.624 0.096 0.936 l -56.052 56.052 L 92.4 108 H 144 c 3.192 0 6.24 -1.26 8.484 -3.516 L 174 82.968 L 205.032 114 l -21.516 21.516 z m 38.472 -38.496 l -31.032 -31.032 l 12.948 -13.008 l 31.116 30.972 l -13.032 13.068 z" />
                </svg>
                <div class="d-flex flex-column justify-content-center align-items-center gap-3">
                    <span class="btn-sign-in"><a href="{{ route('register') }}"></a></span>
                    <a href="{{ route('login') }}">O inicia sesión si ya estás registrado</a>
                </div>
            </div>
        </div>
    </div><!-- End Access -->
    @endguest

    <!-- ======= Scores section ======= -->
    <section id="scores" class="py-5">
        <div class="container py-4">
            <div class="section-title">
                <span>Ranking</span>
                <h2>Ranking</h2>
                <p>Puntuaciones de autores y moderadores.</p>
            </div>

            <div class="d-flex gap-4 flex-column flex-lg-row my-4">
                <div class="container authors-scores">
                    <h4 class="text-center fw-bold text-terciary mb-3">AUTORES</h4>
                    <ul class="list-group organized-list">
                        @foreach($rewardsAuthors as $reward)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span class="organized-item">{{ $reward->name }}</span>
                            <span class="badge bg-primary rounded-pill">{{ $reward->points }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div class="container moderators-scores">
                    <h4 class="text-center fw-bold text-terciary mb-3">MODERADORES</h4>
                    <ul class="list-group organized-list">
                        @foreach($rewardsModerators as $reward)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span class="organized-item">{{ $reward->name }}</span>
                            <span class="badge bg-primary rounded-pill">{{ $reward->points }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section><!-- End Scores -->

    <script>
        let selectHeader = document.querySelector('#navbar')

        if (selectHeader) {
            const headerScrolled = () => {
                if (window.scrollY > 100) {
                    selectHeader.classList.add('navbar-scrolled')
                } else {
                    selectHeader.classList.remove('navbar-scrolled')
                }
            }

            window.addEventListener('load', headerScrolled)

            const sections = document.querySelectorAll("section");
            const navLi = document.querySelectorAll(".nav-link");

            window.onscroll = () => {
                headerScrolled()

                var current = "";

                sections.forEach((section) => {
                    const sectionTop = section.offsetTop;
                    if (pageYOffset >= sectionTop - 60) {
                        current = section.getAttribute("id");
                    }
                });

                navLi.forEach((li) => {
                    li.classList.remove("active");
                    if (li.classList.contains(current)) {
                        li.classList.add("active");
                    }
                });
            };
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>