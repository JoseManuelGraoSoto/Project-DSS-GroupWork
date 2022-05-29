@extends('layouts.add')

@section('valorations-nav')
<div class="nav-item selected flex-container flex-aligned-center">
    <i class='bx bxs-star'></i>
    <span class="nav-label">Valoraciones</span>
</div>
@endsection

@section('text-inputs')
<input type="text" name="title" id="title" placeholder="Titulo del artículo" value="{{old('title')}}">
<input type="text" name="email" id="email" placeholder="Correo del usuario" value="{{old('email')}}">
@endsection

@section('other-inputs')
<div class="inputs flex-container flex-vertical flex-center flex-aligned-center">
    <div class="number-input">
        <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown()"></button>
        <input class="quantity" min="0" max="5" name="quantity" value="{{old('quantity')}}" type="number">
        <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"></button>
    </div>
</div>
@endsection

@section('btn-cancel')
<a href="{{action('App\Http\Controllers\ValorationController@volver')}}">
    <i class='bx bxs-x-circle'></i>
    CANCELAR
</a>
@endsection

@section('scripting')
<script>
    var cb = document.getElementById('checkbox'); // put your id's here
    var tb = document.getElementById('texto');
    if (!cb.checked) { // check state
        tb.style.visibility = 'hidden';
    } else {
        tb.style.visibility = 'visible';
    }
    cb.onchange = function() { // listen for event change
        if (!cb.checked) { // check state
            tb.style.visibility = 'hidden';
        } else {
            tb.style.visibility = 'visible';
        }
    }
</script>
@endsection