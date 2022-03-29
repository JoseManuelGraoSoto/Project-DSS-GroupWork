@extends('layouts.admin')
@section('header')
<link rel="stylesheet" href="{{ URL::asset('css/readers.css'); }}">
<link rel="stylesheet" href="{{ URL::asset('calendar/dist/mc-calendar.min.css'); }}">
<script src="{{ URL::asset('calendar/dist/mc-calendar.min.js'); }}"></script>
@endsection

@section('readers-nav')
<div class="nav-item selected container flex-aligned-center">
    <i class='bx bxs-face'></i>
    <span class="nav-label">Lectores</span>
</div>
@endsection

@section('content')
<div class="override">
    <div class="search-box container flex-vertical flex-aligned-center">
        <span class="search-title">Críterios de búsqueda</span>

        <div class="text-inputs container flex-spaced">
            <input type="text" name="email" id="email" placeholder="Correo eléctronico">
            <input type="text" name="name" id="name" placeholder="Nombre del usuario">
        </div>

        <div class="lower-filter-section container flex-aligned-center flex-center">
            <div class="left-section container">
                <div class="date container">
                    <i class='bx bx-calendar'></i>
                    <input id="datepicker" type="text" placeholder="Fecha de creación" />
                </div>

                <div class="user-type container flex-vertical flex-aligned-center flex-spaced-separated">
                    <div class="types container flex-aligned-center">
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
                                    <span>Administración</span>
                                    <i class='bx bxs-down-arrow'></i>
                                </div>
                            </label>
                        </div>
                    </div>

                    <span class="type-title">Tipo de usuario</span>
                </div>
            </div>


            <div class="right-section">
                <div class="filter-order"></div>
                <div class="filter-button"></div>
            </div>
        </div>
    </div>

    <div class="readers">
        <div class="readers-buttons">

        </div>

        <div class="readers-display">

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
        theme: {
            theme_color: '#2D3436'
        }
    });
</script>
@endsection