@extends('layouts.adminDB')

@section('text-inputs')
<input type="text" name="title" id="title" placeholder="Titulo del artículo">
<input type="text" name="name" id="name" placeholder="Nombre del usuario">
@endsection

@section('reviews-nav')
<div class="nav-item selected container flex-aligned-center">
    <i class='bx bxs-star' ></i>
    <span class="nav-label">Valoraciones</span>
</div>
@endsection

@section('main-buttons')
<button> 
    <i class='bx bx-trash'></i>
    ELIMINAR VALORACIÓN
</button>

<button> 
    <i class='bx bx-rotate-right' ></i>
    MODIFICAR VALORACIÓN
</button>

<button> 
    <i class='bx bx-plus' ></i>
    AÑADIR VALORACIÓN
</button>
@endsection