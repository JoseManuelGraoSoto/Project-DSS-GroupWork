@extends('layouts.adminDB')
@section('form-start')
<form action=" {{ url('searchArticleUsers/') }}" method="POST">
    @csrf
    @endsection
    @section('text-inputs')
    <input type="text" name="user" id="user" placeholder="Titulo del artículo">
    <input type="text" name="name" id="name" placeholder="Nombre del usuario">
    @endsection

    @section('access-nav')
    <div class="nav-item selected flex-container flex-aligned-center">
        <i class='bx bxs-file-export'></i>
        <span class="nav-label">Acceso de usuarios</span>
    </div>
    @endsection

    @section('date')
    <input id="datepicker" type="text" placeholder="Fecha de acceso" />
    @endsection

    @section('main-buttons')
    <a href="/" style="text-decoration: none;">
        <i class='bx bx-trash'></i>
        ELIMINAR ACCESOS
    </a>

    <a href="/" style="text-decoration: none;">
        <i class='bx bx-rotate-right'></i>
        MODIFICAR ACCESO
    </a>

    <a href="/" style="text-decoration: none;">
        <i class='bx bx-plus'></i>
        AÑADIR ACCESO
    </a>
    @endsection

    @section('display')
    <div class="upper-separator flex-container flex-spaced">
        <span class="user-data-label">Usuario</span>
        <span class="user-data-label">Articulo</span>
        <span class="user-data-label">Tipo de usuario</span>
        <span class="user-data-label">Fecha de acceso</span>
    </div>
    @foreach($articles_user as $article_user)
    @foreach ($article_user->access as $acceso)
    <div class="user flex-container flex-aligned-center flex-spaced">
        <span class="user-data">{{$article_user->name}}</span>
        <span class="user-data">{{$acceso->title}}</span>
        <span class="user-data">
            @if ($article_user->type == 'reader')
            Lector
            @elseif ($article_user->type == 'author')
            Autor
            @elseif ($article_user->type == 'moderator')
            Moderador
            @elseif ($article_user->type == 'administrator')
            Administrador
            @else
            No se ha identificado el tipo del usuario
            @endif
        </span>
        <span class="user-data">{{$acceso->created_at}}</span>
    </div>
    @endforeach
    @endforeach
    @endsection