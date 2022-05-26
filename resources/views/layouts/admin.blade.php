<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ URL::asset('css/styles.css'); }}">
    @yield('header')
    <title>Document</title>
</head>

<body>
    @section('sidebar')
    <nav class="sidebar">
        <div class="logo-content">
            <a href="{{ route('adminHome') }}" class="logo flex-container flex-aligned-center">
                <i class='bx bx-pen'></i>
                <div class="logo-name">Invent</div>
            </a>
        </div>

        <div class="menu-btn flex-container flex-center flex-aligned-center">
            <div class="menu-btn__burger"></div>
        </div>

        <ul class="nav-list">
            <li>
                @section('users-nav')
                <a href="{{ route('users') }}" class="nav-item flex-container flex-aligned-center">
                    <i class='bx bxs-face'></i>
                    <span class="nav-label">Usuarios</span>
                </a>
                <span class="nav-tooltip">Usuarios</span>
                @show
            </li>

            <li>
                @section('articles-nav')
                <a href="{{ route('articles') }}" class="nav-item flex-container flex-aligned-center">
                    <i class='bx bxs-file'></i>
                    <span class="nav-label">Artículos</span>
                </a>
                <span class="nav-tooltip">Artículos</span>
                @show
            </li>

            <li>
                @section('access-nav')
                <a href="{{ route('access') }}" class="nav-item flex-container flex-aligned-center">
                    <i class='bx bxs-file-export'></i>
                    <span class="nav-label">Acceso de usuarios</span>
                </a>
                <span class="nav-tooltip">Acceso</span>
                @show
            </li>

            <li>
                @section('categories-nav')
                <a href="{{ route('category') }}" class="nav-item flex-container flex-aligned-center">
                    <i class='bx bxs-category'></i>
                    <span class="nav-label">Categorías</span>
                </a>
                <span class="nav-tooltip">Categorías</span>
                @show
            </li>

            <li>
                @section('valorations-nav')
                <a href="{{ route('valorations') }}" class="nav-item flex-container flex-aligned-center">
                    <i class='bx bxs-star'></i>
                    <span class="nav-label">Valoraciones</span>
                </a>
                <span class="nav-tooltip">Valoraciones</span>
                @show
            </li>

            <li>
                @section('rewards-nav')
                <a href="{{ route('rewards') }}" class="nav-item flex-container flex-aligned-center">
                    <i class='bx bxs-trophy'></i>
                    <span class="nav-label">Recompensas</span>
                </a>
                <span class="nav-tooltip">Recompensas</span>
                @show
            </li>
        </ul>

        <div class="profile-content">
            <div class="profile">
                <div class="profile-details flex-container flex-aligned-center">
                    <img src="{{ URL::asset('img/default.png'); }}" alt="Default user picture">
                    <div class="labels">
                        <div class="name">Temporal</div>
                        <div class="email">Temporal</div>
                    </div>
                </div>

                <a href="{{ route('logout') }}" class='bx bx-log-out' id="log-out" style="text-decoration: none; color: white;" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"></a>
                
                <form id="logout-form" action="{{ route('logout') }}" method="POST" hidden>
                    @csrf
                </form>
            </div>
        </div>
    </nav>
    @show

    <div class="central-panel">
        @yield('content')
    </div>

    <script>
        let dropdown = document.querySelector(".menu-btn");
        let sidebar = document.querySelector(".sidebar");

        dropdown.onclick = function() {
            sidebar.classList.toggle("active");
        }
    </script>

    <script>
        const menuBtn = document.querySelector('.menu-btn');
        let menuOpen = false;

        menuBtn.addEventListener('click', () => {
            if (!menuOpen) {
                menuBtn.classList.add('open');
                menuOpen = true;
            } else {
                menuBtn.classList.remove('open');
                menuOpen = false;
            }
        });
    </script>

    @yield('scripting')
</body>

</html>