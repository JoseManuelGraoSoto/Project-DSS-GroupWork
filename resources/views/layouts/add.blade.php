@extends('layouts.admin')

@section('header')
<link rel="stylesheet" href="{{ URL::asset('css/add.css'); }}">
@yield('extra-header')
@endsection

@section('content')
<div class="override">
    @section('form-start')
    <form action=" {{ url('createUser/') }}" method="POST">
        @csrf
        @show

        <div class="to-fill container flex-spaced">
            @yield('select-img')

            <div class=" text-inputs container flex-vertical flex-aligned-center flex-center">
                @yield('text-inputs')
            </div>

            @yield('other-inputs')
        </div>


        <div class="confirm-btn container">
            <button type="button">
                <i class='bx bxs-x-circle'></i>
                CANCELAR
            </button>

            <button type="submit">
                <i class='bx bx-check-double'></i>
                ACEPTAR
            </button>
        </div>
        @section('form-end')
    </form>
    @show

</div>
@endsection