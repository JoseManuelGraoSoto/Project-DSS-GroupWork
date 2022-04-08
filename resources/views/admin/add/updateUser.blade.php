@extends('layouts.add')

@section('readers-nav')
<div class="nav-item selected container flex-aligned-center">
    <i class='bx bxs-face'></i>
    <span class="nav-label">Lectores</span>
</div>
@endsection

@section('select-img')
<div class="user-image-selection container flex-vertical flex-aligned-center flex-center">
    <img class="user-image" src="{{ URL::asset('img/default.png'); }}" alt="Imagen del usuario">
    <div class="upload-img">
        <input type="file" id="selec-img" />
        <label for="selec-img">Selecciona imagen</label>
    </div>
</div>
@endsection

@section('text-inputs')

<input type="text" name="name" id="name" placeholder="Nombre del usuario">
<input type="password" name="password" id="password" placeholder="Contraseña del usuario">



@endsection

@section('other-inputs')
<div class="text-inputs container flex-aligned-center flex-center flex-vertical">
    <input type="text" name="email" id="email" placeholder="Correo del usuario">
    <input type="text" name="telephone" id="telephone" placeholder="Teléfono del usuario">
</div>
<div class="user-type container flex-vertical flex-center">
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