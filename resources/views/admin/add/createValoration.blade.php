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

    <div style="margin-top: 20px;">
        <div style="margin-top: 20px;">
            <textarea class=" textbox flex-container flex-vertical flex-aligned-center flex-center" style="resize:none" name="texto" id="texto" rows="6" maxlength="300" cols="50" placeholder="Comentario de valoración"></textarea>
        </div>
    </div>
</div>
<div class="checkbox-con flex-container flex-vertical flex-center flex-aligned-center">
    <input id="checkbox" type="checkbox">
    <span style="color: var(--primary-color);">¿Moderador?</span>
</div>
@endsection

@section('btn-cancel')
<a href="{{action('App\Http\Controllers\ValorationController@volver')}}">
    <i class='bx bxs-x-circle'></i>
    CANCELAR
</a>
@endsection