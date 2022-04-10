@extends('layouts.admin')

@section('header')
<link rel="stylesheet" href="{{ URL::asset('css/add.css'); }}">
@yield('extra-header')
@endsection

@section('content')
<div class="override">
    {{-- Error messages --}}
    @if (count($errors) > 0)
        <div class="errors flex-vertical flex-container flex-center flex-aligned-center">
            @foreach ($errors->all() as $error)
                <div class="error-box flex-container flex-center flex-aligned-center">
                    <i class='close bx bx-x'></i>
                    <span class="error-msg">{{ $error }}</span>
                </div>
            @endforeach
        </div>
    @endif

    @section('form-start')
    <form action=" {{ url('createUser/') }}" method="POST">
        @csrf
        @show

        <div class="to-fill flex-container flex-spaced">
            @yield('select-img')

            <div class=" text-inputs flex-container flex-vertical flex-aligned-center flex-center">
                @yield('text-inputs')
            </div>

            @yield('other-inputs')
        </div>


        <div class="confirm-btn flex-container">

            <a href="{{action('App\Http\Controllers\UsersController@volver')}}">
                <i class='bx bxs-x-circle'></i>
                CANCELAR
            </a>

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

@section('scripting')
<script>
    let close_btns = document.querySelectorAll('.close');

    close_btns.forEach(close_btn => {
        close_btn.onclick = function() {
            close_btn.parentElement.remove();
        }
    });
</script>
@endsection