@extends('layouts.add')

@section('rewards-nav')
<div class="nav-item selected flex-container flex-aligned-center">
    <i class='bx bxs-trophy'></i>
    <span class="nav-label">Recompensas</span>
</div>
@endsection

@section('text-inputs')
<input type="email" name="email" id="email" placeholder="Correo del usuario" value="{{old('email')}}">
@endsection

@section('other-inputs')
<div class="inputs flex-container flex-vertical flex-center flex-aligned-center">
    <div class="number-input" style="width: 300px;">
        <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown()"></button>
        <input class="quantity" min="0" name="quantity" value="{{old('quantity')}}" type="number" style="max-width: 200px">
        <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"></button>
    </div>

    <div class="checkbox-con flex-container flex-vertical flex-center flex-aligned-center">
        <input id="checkbox" type="checkbox" name="isModerator" {{(old('isModerator') ? 'checked' : '')}}>
        <span style="color: var(--primary-color);">¿Moderador?</span>
    </div>
</div>
@endsection

@section('btn-cancel')
<a href="{{action('App\Http\Controllers\RewardController@volver')}}">
    <i class='bx bxs-x-circle'></i>
    CANCELAR
</a>
@endsection