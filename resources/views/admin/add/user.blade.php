@extends('layouts.admin')

@section('header')
<link rel="stylesheet" href="{{ URL::asset('css/add.css'); }}">
@endsection

@section('content')
<div class="override">
    <div class="to-fill container flex-spaced">
        <div class="user-image-selection container flex-vertical flex-aligned-center flex-center">
            <img class="user-image" src="{{ URL::asset('img/default.png'); }}" alt="Imagen del usuario">
            <div class="upload-img">
                <input type="file" id="selec-img"/>
                <label for="selec-img">Selecciona imagen</label>
            </div>
        </div>

        <div class="text-inputs container flex-vertical flex-aligned-center flex-center">
            <input type="text" name="name" id="name" placeholder="Nombre del usuario">
            <input type="text" name="email" id="email" placeholder="Correo del usuario">
            <input type="text" name="telephone" id="telephone" placeholder="Teléfono del usuario">
        </div>

        <div class="user-type container flex-vertical flex-center">
            <label class="form-control">
                <input type="radio" name="radio" checked />
                Lector
            </label>

            <label class="form-control">
                <input type="radio" name="radio" />
                Autor
            </label>

            <label class="form-control">
                <input type="radio" name="radio" />
                Moderador
            </label>

            <label class="form-control">
                <input type="radio" name="radio" />
                Administrador
            </label>
        </div>
    </div>

    <div class="user-buttons">

    </div>
</div>
@endsection