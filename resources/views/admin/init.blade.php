@extends('layouts.admin')

@section('header')
<link rel="stylesheet" href="{{ URL::asset('css/3DAnimation.css'); }}">
@endsection

@section('content')
<div class="override">
    <h1 class="jt --debug">
        <span class="jt__row">
            <span class="jt__text">Bienvenido</span>
        </span>
        <span class="jt__row jt__row--sibling" aria-hidden="true">
            <span class="jt__text">Bienvenido</span>
        </span>
        <span class="jt__row jt__row--sibling" aria-hidden="true">
            <span class="jt__text">Bienvenido</span>
        </span>
        <span class="jt__row jt__row--sibling" aria-hidden="true">
            <span class="jt__text">Bienvenido</span>
        </span>
    </h1>
    <div class="button">
        <a id="btn" href="{{ route('home') }}" style="text-decoration: none;">
            REGRESAR A INICIO
        </a>
    </div>
</div>
@endsection