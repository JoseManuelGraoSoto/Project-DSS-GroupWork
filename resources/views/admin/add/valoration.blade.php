@extends('layouts.add')

@section('valorations-nav')
<div class="nav-item selected flex-container flex-aligned-center">
    <i class='bx bxs-star'></i>
    <span class="nav-label">Valoraciones</span>
</div>
@endsection

@section('text-inputs')
<input type="text" name="title" id="title" placeholder="Titulo del artículo">
<input type="text" name="email" id="email" placeholder="Correo del usuario">
@endsection

@section('other-inputs')
<div class="inputs flex-container flex-vertical flex-center flex-aligned-center">
    <div class="number-input">
        <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()"></button>
        <input class="quantity" min="0" max="10" name="quantity" value="5" type="number">
        <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"></button>
    </div>

    <div class="upload-txt" style="margin-top: 20px;">
        <input type="file" id="selec-txt" />
        <label for="selec-txt">Contenido del artículo</label>
    </div>
</div>
<div class="checkbox-con flex-container flex-vertical flex-center flex-aligned-center">
    <input id="checkbox" type="checkbox">
    <span style="color: var(--primary-color);">¿Moderador?</span>
</div>
@endsection