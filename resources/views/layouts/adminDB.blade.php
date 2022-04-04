@extends('layouts.admin')

@section('header')
<link rel="stylesheet" href="{{ URL::asset('css/styleDB.css'); }}">
<link rel="stylesheet" href="{{ URL::asset('calendar/dist/mc-calendar.min.css'); }}">
<script src="{{ URL::asset('calendar/dist/mc-calendar.min.js'); }}"></script>
@yield('extra-header')
@endsection

@section('content')
<div class="override">
    <div class="search-box container flex-vertical flex-aligned-center" style="justify-content: space-between;">
        <span class="search-title">Críterios de búsqueda</span>

        <div class="text-inputs container flex-spaced">
            @yield('text-inputs')
        </div>

        <div class="lower-filter-section container flex-aligned-center flex-spaced">
            <div class="left-section container">
                <div class="date container">
                    <i class='bx bx-calendar'></i>
                    <input id="datepicker" type="text" placeholder="Fecha de creación" />
                </div>

                @section('user-type')
                <div class="user-type container flex-vertical flex-aligned-center">
                    <div class="types container">
                        <div class="type">
                            <input checked="" type="checkbox" id="reader-type" class="hidden-xs-up">
                            <label for="reader-type" class="cbx">
                                <div class="type-tooltip">
                                    <span>Lector</span>
                                    <i class='bx bxs-down-arrow'></i>
                                </div>
                            </label>
                        </div>
                        <div class="type">
                            <input checked="" type="checkbox" id="author-type" class="hidden-xs-up">
                            <label for="author-type" class="cbx">
                                <div class="type-tooltip">
                                    <span>Autor</span>
                                    <i class='bx bxs-down-arrow'></i>
                                </div>
                            </label>
                        </div>
                        <div class="type">
                            <input checked="" type="checkbox" id="moderator-type" class="hidden-xs-up">
                            <label for="moderator-type" class="cbx">
                                <div class="type-tooltip">
                                    <span>Moderador</span>
                                    <i class='bx bxs-down-arrow'></i>
                                </div>
                            </label>
                        </div>
                        <div class="type">
                            <input checked="" type="checkbox" id="administrator-type" class="hidden-xs-up">
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

            <div class="right-section container flex-aligned-center">
                <div class="filter-order">
                    <label class="switch">
                        <input id="sort" type="checkbox">
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

    <div class="main-panel">
        <div class="main-buttons container">
            @yield('main-buttons')
        </div>

        <div class="display">
            @yield('display')
        </div>
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
    let icon_dropdown = document.querySelector('#filter-dropdown i')

    filter_dropdown.onclick = function() {
        filter.classList.toggle("active");
        icon_dropdown.classList.toggle("up");
    }
</script>
@endsection