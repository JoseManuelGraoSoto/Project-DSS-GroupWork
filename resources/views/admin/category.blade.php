@extends('layouts.admin')

@section('header')
<link rel="stylesheet" href="{{ URL::asset('css/category.css'); }}">
@endsection

@section('categories-nav')
<div class="nav-item selected container flex-aligned-center">
    <i class='bx bxs-face'></i>
    <span class="nav-label">Categorias</span>
</div>
@endsection

@section('content')
<div class="override">
    <div class="container ">
        <div>
            <h1 class="category-text">Categorias</h1>
        </div>

        <div class="right main-panel">
            <form action="{{ route('category.create') }}" method="GET">
                <div class="main-buttons">
                    <button>
                        <a target="_blanck" style=" text-decoration: none; color: #fff;">
                            <i class='bx bx-plus' id="mas"></i>
                            AÑADIR CATEGORIA
                        </a>
                    </button>
                </div>
                <div class="botones">
                    <input type="text" name="categoria" id="categoria" placeholder="Categoría">
                    <div class="filter-button">
                        <button class="cssbuttons-io-button"> Buscar
                            <div class="icon">
                                <i class='bx bx-search-alt-2'></i>
                            </div>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div>
        <form action="{{ route('category.delete') }}" method="GET">
            @csrf
            <div class="center-category">
                <div class="container-category">
                    <div class="upper-separator category">
                        <div class="separator">
                            <span class="display-data-label">Nombre</span>
                        </div>
                    </div>
                    <div class="categorias">
                        @foreach($categorys as $category)
                        <div class="info-db flex-container flex-aligned-center">
                            <input type="checkbox" id="{{$category->category}}" name="{{$category->category}}"
                                class="Checkbox" value="1">
                            <label for="{{$category->category}}">{{$category->category}}</label>
                        </div>
                        @endforeach
                    </div>

                </div>
            </div>
            <div>
                <div class="bottom-category main-panel">
                    <div class="main-buttons bottom" id="boton_category">
                        <button class="basura" id="basura_category">
                            <i class='bx bx-trash'></i>
                            ELIMINAR CATEGORIA
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripting')
<script>
let filter_dropdown = document.querySelector("#filter-dropdown");
let filter = document.querySelector(".search-box");
let icon_dropdown = document.querySelector('#filter-dropdown i')

filter_dropdown.onclick = function() {
    filter.classList.toggle("active");
    icon_dropdown.classList.toggle("up");
}
</script>
@endsection