@extends('layouts.add')

@section('articles-nav')

<div class="nav-item selected flex-container flex-aligned-center">
    <i class='bx bxs-file'></i>
    <span class="nav-label">Artículos</span>
</div>
@endsection
@section('form-start')
<form action=" {{ url('createArticle/') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @show
    @section('text-inputs')
    <input type="text" name="title" id="title" placeholder="Titulo del artículo" value="{{old('title')}}">
    <input type=" text" name="author" id="author" placeholder="Nombre del autor" value="{{old('author')}}">
    @endsection

    @section('other-inputs')
    <div class=" inputs1 flex-container flex-vertical flex-center flex-aligned-center">
        <select name="category" id="category-input" style="margin-bottom: 40px;">
            <option value="default" id="default-category" {{(strcmp(old('category'), 'default') == 0) ? 'selected' : ''}}>Seleccione una categoría</option>
            <option value="Ciencia" {{(strcmp(old('category'), 'Ciencia') == 0) ? 'selected' : ''}}>Ciencia</option>
            <option value="Biologia" {{(strcmp(old('category'), 'Biologia') == 0) ? 'selected' : ''}}>Biologia</option>
            <option value="Computación" {{(strcmp(old('category'), 'Computación') == 0) ? 'selected' : ''}}>Computación</option>
            <option value="Machine Learning" {{(strcmp(old('category'), 'Machine Learning') == 0) ? 'selected' : ''}}>Machine Learning</option>
        </select>
        <div class="upload-txt">
            <input type="file" id="selec-txt" accept="text/plain, .pdf, .doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
            <label for="selec-txt">Contenido del artículo</label>
        </div>
    </div>

    <div class="inputs2 flex-container flex-vertical flex-center flex-aligned-center">
        <div class="flex-container flex-vertical flex-center flex-aligned-center">
            <span style="color: var(--primary-color);">Valoración general del artículo</span>
            <div class="number-input">
                <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown()"></button>
                <input class="quantity" min="0" max="10" step=".5" name="quantity" value="{{old('quantity')}}" type="number">
                <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"></button>
            </div>
        </div>

        <div class="checkbox-con flex-container flex-vertical flex-center flex-aligned-center">
            <input id="checkbox" type="checkbox" name="accepted" checked="old('accepted')">
            <span style="color: var(--primary-color);">¿Aceptado?</span>
        </div>
    </div>
    @endsection

    @section('btn-cancel')
    <a href="{{action('App\Http\Controllers\ArticlesController@volver')}}">
        <i class='bx bxs-x-circle'></i>
        CANCELAR
    </a>
    @endsection