@extends('layouts.add')

@section('text-inputs')
<input type="text" name="title" id="title" placeholder="Titulo del artículo">
<input type="text" name="author" id="author" placeholder="Nombre del autor">
@endsection

@section('other-inputs')
<div class="inputs container flex-vertical flex-center flex-aligned-center">
    <select name="category" id="category-input">
        <option selected value="default" id="default-category">Seleccione una categoría</option>
        <option value="Categoria1">Categoria1</option>
        <option value="Categoria2">Categoria2</option>
        <option value="Categoria3">Categoria3</option>                              
    </select>

    <div class="upload-txt">
        <input type="file" id="selec-txt"/>
        <label for="selec-img">Contenido del artículo</label>
    </div>

    <input type="number" name="valoration" id="valoration" placeholder="Valoración general del artículo">

    <div class="checkbox-con">
        <span style="color: black;">¿Aceptado?</span>
        <input id="checkbox" type="checkbox">
    </div>
</div>
@endsection