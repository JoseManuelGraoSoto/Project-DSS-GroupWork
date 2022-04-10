@extends('layouts.admin')

@section('header')
<link rel="stylesheet" href="{{ URL::asset('css/3DAnimation.css'); }}">
@endsection

@section('content')
<div class="override">
    <ul class="Words">
        <li class="Words-line">
            <p>&nbsp;</p>
            <p>Bienvenido</p>
        </li>
        <li class="Words-line">
            <p>Bienvenido</p>
            <p>al panel</p>
        </li>
        <li class="Words-line">
            <p>al panel</p>
            <p>de control</p>
        </li>
        <li class="Words-line">
            <p>de control</p>
            <p> </p>
        </li>
        <li class="Words-line">
            <p> </p>
            <p>Usuario</p>
        </li>
        <li class="Words-line">
            <p>Usuario</p>
            <p>Temporal</p>
        </li>
        <li class="Words-line">
            <p>Temporal</p>
            <p>&nbsp;</p>
        </li>
    </ul>
</div>
@endsection