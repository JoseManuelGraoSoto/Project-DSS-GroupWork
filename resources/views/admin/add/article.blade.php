@extends('layouts.add')

@section('articles-nav')
<div class="nav-item selected container flex-aligned-center">
    <i class='bx bxs-file'></i>
    <span class="nav-label">Artículos</span>
</div>
@endsection
@section('form-start')
<form action=" {{ url('createArticle/') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @show
    @section('text-inputs')
    <input type="text" name="title" id="title" placeholder="Titulo del artículo">
    <input type="text" name="author" id="author" placeholder="Nombre del autor">
    @endsection

    @section('other-inputs')
    <div class="inputs1 container flex-vertical flex-center flex-aligned-center">
        <select name="category" id="category-input" style="margin-bottom: 40px;">
            <option selected value="default" id="default-category">Seleccione una categoría</option>
            <option value="Ciencia">Ciencia</option>
            <option value="Biologia">Biologia</option>
            <option value="Computación">Computación</option>
            <option value="Machine Learning">Machine Learning</option>
        </select>

        <div class="upload-txt">
            <input type="file" id="selec-txt" accept="text/plain, .pdf, .doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
            <label for="selec-txt">Contenido del artículo</label>
        </div>
    </div>

    <div class="inputs2 container flex-vertical flex-center flex-aligned-center">
        <div class="container flex-vertical flex-center flex-aligned-center">
            <span style="color: var(--primary-color);">Valoración general del artículo</span>
            <div class="number-input">
                <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown()"></button>
                <input class="quantity" min="0" max="10" step=".5" name="quantity" value="5" type="number">
                <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"></button>
            </div>
        </div>

        <div class="checkbox-con container flex-vertical flex-center flex-aligned-center">
            <input id="checkbox" type="checkbox">
            <span style="color: var(--primary-color);">¿Aceptado?</span>
        </div>
    </div>
    @endsection