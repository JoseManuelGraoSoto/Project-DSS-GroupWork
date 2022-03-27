<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ URL::asset('css/styles.css'); }}">
    <title>Document</title>
</head>
<body>
    @section('sidebar')
    <nav class="sidebar">
        <div class="logo-content">
            <div class="logo container flex-aligned-center">
                <i class='bx bxs-face' ></i>
                <div class="logo-name">Invent</div>
            </div>
        </div>

        <div class="menu-btn container flex-center flex-aligned-center">
            <div class="menu-btn__burger"></div>
        </div>

        <ul class="nav-list">
            <li>
                <a href="#" class="nav-item container flex-aligned-center">
                    <i class='bx bxs-face' ></i>
                    <span class="nav-label">Lectores</span>
                </a>
                <span class="nav-tooltip">Lectores</span>
            </li>

            <li>
                <a href="#" class="nav-item container flex-aligned-center">
                    <i class='bx bxs-file' ></i>
                    <span class="nav-label">Artículos</span>
                </a>
                <span class="nav-tooltip">Artículos</span>
            </li>

            <li>
                <a href="#" class="nav-item container flex-aligned-center">
                    <i class='bx bxs-category' ></i>
                    <span class="nav-label">Categorías</span>
                </a>
                <span class="nav-tooltip">Categorías</span>
            </li>

            <li>
                <a href="#" class="nav-item container flex-aligned-center">
                    <i class='bx bxs-star' ></i>
                    <span class="nav-label">Valoraciones</span>
                </a>
                <span class="nav-tooltip">Valoraciones</span>
            </li>

            <li>
                <a href="#" class="nav-item container flex-aligned-center">
                    <i class='bx bxs-trophy' ></i>
                    <span class="nav-label">Recompensas</span>
                </a>
                <span class="nav-tooltip">Recompensas</span>
            </li>

            <!-- <li>
                <a href="#" class="nav-item container flex-aligned-centered">
                    <i class='bx bxs-home' ></i>
                    <span class="nav-label">Inicio</span>
                </a>
                <span class="nav-tooltip">Inicio</span>
            </li> -->
        </ul>

        <div class="profile-content">
            <div class="profile">
                <div class="profile-details container flex-aligned-center">
                    <img src="{{ URL::asset('img/default.png'); }}" alt="Default user picture">
                    <div class="labels">
                        <div class="name">Temporal</div>
                        <div class="email">Temporal</div>
                    </div>
                </div>
                <i class='bx bx-log-out' id="log-out"></i>
            </div>
        </div>
    </nav>
    @show

    <div class="central-panel">
        <div class="override">
        @yield('content')
        </div>
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
            if(!menuOpen) {
                menuBtn.classList.add('open');
                menuOpen = true;
            } else {
                menuBtn.classList.remove('open');
                menuOpen = false;
            }
        });
    </script>
</body>
</html>