@extends('layouts.add')

@section('articles-nav')
<div class="nav-item selected flex-container flex-aligned-center">
    <i class='bx bxs-file'></i>
    <span class="nav-label">Artículos</span>
</div>
@endsection

@section('text-inputs')
<input type="text" name="title" id="title" placeholder="Titulo del artículo" value="{{($article) ? $article->title : old('title')}}">
<input type="email" name="author" id="author" placeholder="Email del autor" value="{{($article) ? $article->user->email : old('author')}}">
@endsection

@section('other-inputs')
<input type="hidden" id="id" name="article_id" value="{{($article) ? $article->id : old('article_id')}}">
<div class=" inputs1 flex-container flex-vertical flex-center flex-aligned-center">
    <select name="category" id="category-input" style="margin-bottom: 40px;">
        <option value="default" id="default-category">Seleccione una categoría</option>
        <option value="Ciencia" {{(($article && strcmp($article->category, 'Ciencia') == 0) ? 'selected' : (strcmp(old('category'), 'Ciencia') == 0)) ? 'selected' : ''}}>Ciencia</option>
        <option value="Biologia" {{(($article && strcmp($article->category, 'Biologia') == 0) ? 'selected' : (strcmp(old('category'), 'Biologia') == 0)) ? 'selected' : ''}}>Biologia</option>
        <option value="Computación" {{(($article && strcmp($article->category, 'Computación') == 0) ? 'selected' : (strcmp(old('category'), 'Computación')) == 0) ? 'selected' : ''}}>Computación</option>
        <option value="Machine Learning" {{(($article && strcmp($article->category, 'Machine Learning') == 0) ? 'selected' : (strcmp(old('category'), 'Machine Learning') == 0)) ? 'selected' : ''}}>Machine Learning</option>
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
            <input class="quantity" min="0" max="10" step=".1" name="quantity" value="{{($article) ? $article->valoration : old('quantity')}}" type="number">
            <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"></button>
        </div>
    </div>

    <div class="checkbox-con flex-container flex-vertical flex-center flex-aligned-center">
        <input id="checkbox" name="accepted" type="checkbox" {{($article) ? (($article->acepted) ? 'checked' : '') : ((old('accepted')) ? 'checked' : '')}}>
        <span style=" color: var(--primary-color);">¿Aceptado?</span>
    </div>
</div>
@endsection

@section('btn-cancel')
<a href="{{action('App\Http\Controllers\ArticlesController@volver')}}">
    <i class='bx bxs-x-circle'></i>
    CANCELAR
</a>
@endsection