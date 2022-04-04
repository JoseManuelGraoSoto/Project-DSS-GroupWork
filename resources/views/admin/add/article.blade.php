@extends('layouts.add')

@section('text-inputs')
<input type="text" name="title" id="title" placeholder="Titulo del artículo">
<input type="text" name="author" id="author" placeholder="Nombre del autor">
@endsection

@section('other-inputs')
<div class="inputs1 container flex-vertical flex-center flex-aligned-center">
    <select name="category" id="category-input" style="margin-bottom: 40px;">
        <option selected value="default" id="default-category">Seleccione una categoría</option>
        <option value="Categoria1">Categoria1</option>
        <option value="Categoria2">Categoria2</option>
        <option value="Categoria3">Categoria3</option>                              
    </select>

    <div class="upload-txt">
        <input type="file" id="selec-txt"/>
        <label for="selec-img">Contenido del artículo</label>
    </div>
</div>

<div class="inputs2 container flex-vertical flex-center flex-aligned-center">
    <div class="container flex-vertical flex-center flex-aligned-center">
        <span style="color: var(--primary-color);">Valoración general del artículo</span>
        <div class="number-input">
            <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()" ></button>
            <input class="quantity" min="0" max="10" step=".5" name="quantity" value="1" type="number">
            <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"></button>
        </div>
    </div>
    
    <div class="checkbox-con container flex-vertical flex-center flex-aligned-center">
        <input id="checkbox" type="checkbox">
        <span style="color: var(--primary-color);">¿Aceptado?</span>
    </div>
</div>
@endsection