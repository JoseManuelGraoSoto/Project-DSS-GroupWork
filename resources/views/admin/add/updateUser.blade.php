@extends('layouts.add')

@section('users-nav')
<div class="nav-item selected flex-container flex-aligned-center">
    <i class='bx bxs-face'></i>
    <span class="nav-label">Usuarios</span>
</div>
@endsection

@section('select-img')
<div class="user-image-selection flex-container flex-vertical flex-aligned-center flex-center">
    <img class="user-image" src="{{URL::asset('storage/users/'. $user->imagen_path);}}" id="foto_add" alt="Imagen del usuario">
    <div class="upload-img">
        <input type="file" name="selec-img" id="selec-img" />
        <label for="selec-img">Selecciona imagen</label>
    </div>
</div>
@endsection

@section('text-inputs')
<input type="hidden" name="user_id" id="user_id" value="{{($user) ? $user->id : old('user_id')}}">
<input type="text" name="name" id="name" placeholder="Nombre del usuario" value="{{($user) ? $user->name : old('name')}}">
<input type="password" name="password" id="password" placeholder="Contraseña del usuario" value="{{($user) ? $user->password : old('password')}}">
@endsection

@section('other-inputs')
<div class=" text-inputs flex-container flex-aligned-center flex-center flex-vertical">
    <input type="text" name="email" id="email" placeholder="Correo del usuario" value="{{($user) ? $user->email : old('email')}}">
    <input type="text" name="telephone" id="telephone" placeholder="Teléfono del usuario" value="{{($user) ? $user->telephone : old('telephone')}}">
</div>
<div class="flex-container flex-vertical flex-center flex-aligned-center">
    <span style="color: var(--primary-color);">Numero de días suscrito</span>
    <div class="number-input">
        <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown()"></button>
        <input class="quantity" min="0" max="365" step="1" id="number_days" name="number_days"
            value="{{old('number_days')}}" type="number">
        <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp()"
            class="plus"></button>
    </div>
</div>
<div class="user-type flex-container flex-vertical flex-center">
    <label class="form-control">
        <input type="radio" name="radio" value="reader" id="radio_button1" checked />
        Lector
    </label>

    <label class="form-control">
        <input type="radio" name="radio" value="author" id="radio_button2" />
        Autor
    </label>

    <label class="form-control">
        <input type="radio" name="radio" value="moderator" id="radio_button3" />
        Moderador
    </label>

    <label class="form-control">
        <input type="radio" name="radio" value="administrator" id="radio_button4" />
        Administrador
    </label>
</div>
@endsection