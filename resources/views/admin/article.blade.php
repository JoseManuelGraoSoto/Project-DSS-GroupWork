@extends('layouts.adminDB')
@section('form-start')
<form action=" {{ url('articles/') }}" method="GET">
    @csrf
    @endsection
    @section('text-inputs')
    <input type="text" name="title" id="title" placeholder="Titulo del artículo">
    <input type="text" name="author" id="author" placeholder="Nombre del autor">
    @endsection

    @section('articles-nav')
    <div class="nav-item selected flex-container flex-aligned-center">
        <i class='bx bxs-file'></i>
        <span class="nav-label">Artículos</span>
    </div>
    @endsection

    @section('user-type')

    @endsection

    @section('main-buttons')
    <a href="/" style="text-decoration: none;">
        <i class='bx bx-trash'></i>
        ELIMINAR ARTICULOS
    </a>

    <a href="/" style="text-decoration: none;">
        <i class='bx bx-rotate-right'></i>
        MODIFICAR ARTICULO
    </a>

    <a href="/createArticleForm" style="text-decoration: none;">
        <i class='bx bx-plus'></i>
        AÑADIR ARTICULO
    </a>
    @endsection

    @section('display')
    <div class="upper-separator flex-container flex-spaced">
        <span class="user-data-label">ID</span>
        <span class="user-data-label">Titulo</span>
        <span class="user-data-label">Categoría</span>
        <span class="user-data-label">Valoración</span>
        <span class="user-data-label">¿Aceptado?</span>
        <span class="user-data-label">Autor</span>
        <span class="user-data-label">Fecha de creación</span>
        <span class="user-data-label">Última modificación</span>
    </div>
    @foreach($articles as $article)
    <div class="user flex-container flex-aligned-center flex-spaced">
        <span class="user-data">{{$article->id}}</span>
        <span class="user-data">{{$article->title}}</span>
        <span class="user-data">{{$article->category}}</span>
        <span class="user-data">{{$article->valoration}}</span>
        <span class="user-data">
            @if($article->acepted)
            Aceptado
            @else
            No Aceptado
            @endif
        </span>
        <span class="user-data">{{$article->user->email}}</span>
        <span class="user-data">{{$article->created_at}}</span>
        <span class="user-data">{{$article->updated_at}}</span>
    </div>
    @endforeach
    @endsection

    @section('paginate')
    {{ $articles->links('vendor.pagination.custom') }}
    @endsection