@extends('layouts.adminDB')
@section('form-start')
<form action=" {{ url('searchArticle/') }}" method="POST">
    @csrf
    @endsection
    @section('text-inputs')
    <input type="text" name="title" id="title" placeholder="Titulo del artículo">
    <input type="text" name="author" id="author" placeholder="Nombre del autor">
    @endsection

    @section('articles-nav')
    <div class="nav-item selected container flex-aligned-center">
        <i class='bx bxs-file'></i>
        <span class="nav-label">Artículos</span>
    </div>
    @endsection

    @section('user-type')

    @endsection

    @section('main-buttons')
    <button>
        <i class='bx bx-trash'></i>
        ELIMINAR ARTICULOS
    </button>

    <button>
        <i class='bx bx-rotate-right'></i>
        MODIFICAR ARTICULO
    </button>

    <button>
        <i class='bx bx-plus'></i>
        AÑADIR ARTICULO
    </button>
    @endsection

    @section('display')
    <div>
        @foreach($articles as $article)
        <li> {{$article->title}} </li>
        @endforeach
    </div>
    @endsection