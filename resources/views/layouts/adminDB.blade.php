@extends('layouts.admin')

@section('header')
<link rel="stylesheet" href="{{ URL::asset('css/styleDB.css'); }}">
<link rel="stylesheet" href="{{ URL::asset('calendar/dist/mc-calendar.min.css'); }}">
<script src="{{ URL::asset('calendar/dist/mc-calendar.min.js'); }}"></script>
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
@yield('extra-header')
@endsection

@section('content')
<div class="override">

    @section('form-start')
    <form action=" {{ url('users/') }}" method="GET">
        @csrf
        @show
        <div class="search-box flex-container flex-vertical flex-aligned-center" style="justify-content: space-between;">
            <span class="search-title">Críterios de búsqueda</span>

            <div class="text-inputs flex-container flex-spaced">
                @yield('text-inputs')
            </div>

            <div class="lower-filter-section flex-container flex-aligned-center flex-spaced">
                <div class="left-section flex-container">
                    <div class="date flex-container">
                        <i class='bx bx-calendar'></i>
                        @section('date')
                        <input readonly id="datepicker" name="datepicker" type="text" placeholder="Fecha de creación" />
                        @show
                    </div>

                    @section('user-type')
                    <div class="user-type flex-container flex-vertical flex-aligned-center">
                        <div class="types flex-container">
                            <div class="type">
                                <input checked="" type="checkbox" name="readerCheckbox" id="reader-type" class="hidden-xs-up">
                                <label for="reader-type" class="cbx">
                                    <div class="type-tooltip">
                                        <span>Usuario</span>
                                        <i class='bx bxs-down-arrow'></i>
                                    </div>
                                </label>
                            </div>
                            <div class="type">
                                <input checked="" type="checkbox" name="authorCheckbox" id="author-type" class="hidden-xs-up">
                                <label for="author-type" class="cbx">
                                    <div class="type-tooltip">
                                        <span>Autor</span>
                                        <i class='bx bxs-down-arrow'></i>
                                    </div>
                                </label>
                            </div>
                            <div class="type">
                                <input checked="" type="checkbox" name="moderatorCheckbox" id="moderator-type" class="hidden-xs-up">
                                <label for="moderator-type" class="cbx">
                                    <div class="type-tooltip">
                                        <span>Moderador</span>
                                        <i class='bx bxs-down-arrow'></i>
                                    </div>
                                </label>
                            </div>
                            <div class="type">
                                <input checked="" type="checkbox" name="administratorCheckbox" id="administrator-type" class="hidden-xs-up">
                                <label for="administrator-type" class="cbx">
                                    <div class="type-tooltip">
                                        <span>Administrador</span>
                                        <i class='bx bxs-down-arrow'></i>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <span class="type-title">Tipo de usuario</span>
                    </div>
                    @show
                </div>

                <div class="right-section flex-container flex-aligned-center">
                    <div class="filter-order">
                        <label class="switch">
                            <input id="sort" name="order" type="checkbox">
                            <span class="slider"></span>
                        </label>
                    </div>

                    <div class="filter-button">
                        <button class="cssbuttons-io-button"> Buscar
                            <div class="icon">
                                <i class='bx bx-search-alt-2'></i>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div id="filter-dropdown">
            <i class='bx bxs-chevrons-down'></i>
        </div>
        @section('form-end')
    </form>
    @show
    <div class="main-panel">
        <div class="main-buttons flex-container">
            @yield('main-buttons')
        </div>

        <div class="display flex-container flex-vertical">
            @yield('display')
        </div>

        @yield('paginate')
    </div>
</div>
@endsection

@section('scripting')
<script>
    const picker = MCDatepicker.create({
        el: '#datepicker',
        disableWeekends: false,
        customWeekDays: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
        customMonths: [
            'Enero',
            'Febrero',
            'Marzo',
            'Abril',
            'Mayo',
            'Junio',
            'Julio',
            'Agosto',
            'Septiembre',
            'Octubre',
            'Noviembre',
            'Diciembre'
        ],
        customOkBTN: 'Aceptar',
        customCancelBTN: 'Cancelar',
        customClearBTN: 'Limpiar',
        dateFormat: 'dddd, dd mmmm yyyy',
        theme: {
            theme_color: '#2D3436'
        }
    });
</script>

<script>
    let filter_dropdown = document.querySelector("#filter-dropdown");
    let filter = document.querySelector(".search-box");
    let icon_dropdown = document.querySelector('#filter-dropdown i');

    filter_dropdown.onclick = function() {
        filter.classList.toggle("active");
        icon_dropdown.classList.toggle("up");
    }
</script>

<script>
    let select = document.querySelectorAll('.info-db');

    Array.from(select).forEach(instance => {
        instance.addEventListener('click', function(e) {
            e.target.classList.toggle('active');
        });
    });
</script>

<script>
    let eliminate = document.querySelector('#delete-btn');

    eliminate.onclick = function() {
        let active_selections = document.querySelectorAll('.user.active');

        const to_eliminate = [];
        let i = 0;
        Array.from(active_selections).forEach(instance => {
            to_eliminate[i] = instance.querySelector('#id').textContent;
            i++;
        });

        let redirect = encodeURIComponent(JSON.stringify(to_eliminate));
        window.location.replace("delete_{{ request()->route()->getName() }}?{{ request()->route()->getName() }}=" + redirect);
    }
</script>
@endsection