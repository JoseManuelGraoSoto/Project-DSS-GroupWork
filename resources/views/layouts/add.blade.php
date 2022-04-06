@extends('layouts.admin')

@section('header')
<link rel="stylesheet" href="{{ URL::asset('css/add.css'); }}">
@yield('extra-header')
@endsection

@section('content')
<div class="override">
    <div class="to-fill flex-container flex-spaced">
        @yield('select-img')
        
        <div class="text-inputs flex-container flex-vertical flex-aligned-center flex-center">
            @yield('text-inputs')
        </div>
        
        @yield('other-inputs')
    </div>

    <div class="confirm-btn flex-container">
        <button> 
            <i class='bx bxs-x-circle' ></i>
            CANCELAR
        </button>

        <button> 
            <i class='bx bx-check-double'></i>
            ACEPTAR
        </button>
    </div>
</div>
@endsection