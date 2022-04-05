@extends('layouts.add')

@section('rewards-nav')
<div class="nav-item selected container flex-aligned-center">
    <i class='bx bxs-trophy' ></i>
    <span class="nav-label">Recompensas</span>
</div>
@endsection

@section('text-inputs')
<input type="text" name="email" id="email" placeholder="Correo del usuario">
@endsection

@section('other-inputs')
<div class="inputs container flex-vertical flex-center flex-aligned-center">
    <div class="number-input" style="width: 300px;">
        <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()" ></button>
        <input class="quantity" min="0" name="quantity" value="100" type="number" style="max-width: 200px">
        <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"></button>
    </div>

    <div class="checkbox-con container flex-vertical flex-center flex-aligned-center">
        <input id="checkbox" type="checkbox">
        <span style="color: var(--primary-color);">¿Moderador?</span>
    </div>
</div>
@endsection