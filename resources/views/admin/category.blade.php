@extends('layouts.admin')
@section('header')
<link rel="stylesheet" href="{{ URL::asset('css/category.css'); }}">
@endsection

@section('categories-nav')
<div class="nav-item selected container flex-aligned-center">
    <i class='bx bxs-category'></i>
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
                <div class="main-buttons">
                    <button> 
                        <i class='bx bx-plus' ></i>
                        AÑADIR CATEGORIA
                    </button>
                </div>
                <div>
                    <input type="text" name="categoria" id="categoria" placeholder="Categoría">
                </div>
            </div>
        </div>
        <div class="center-category">

        </div>
        <div class="bottom-category main-panel"> 
                <div class="main-buttons bottom" id="boton_category">
                    <button class="basura" id="basura_category"> 
                        <i class='bx bx-trash' ></i>
                        ELIMINAR CATEGORIA 
                    </button>
                </div>
        </div>
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