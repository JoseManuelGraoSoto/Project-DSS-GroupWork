@extends('layouts.adminDB')

@section('text-inputs')
<input type="text" name="title" id="title" placeholder="Titulo del artículo">
<input type="text" name="author" id="email" placeholder="Email del usuario">
@endsection

@section('access-nav')
<div class="nav-item selected flex-container flex-aligned-center">
    <i class='bx bxs-file-export'></i>
    <span class="nav-label">Acceso de usuarios</span>
</div>
@endsection

@section('date')
<input readonly id="datepicker" type="text" placeholder="Fecha de acceso" />
@endsection

@section('main-buttons')
<button id="delete-btn" style="text-decoration: none;">
    <i class='bx bx-trash'></i>
    ELIMINAR ACCESOS
</button>

<a href="{{ route('access') }}" style="text-decoration: none; display: none;">
    <i class='bx bx-plus'></i>
    AÑADIR ACCESO
</a>
@endsection

@section('display')
<div class="upper-separator access">
    <span class="display-data-label">ID</span>
    <span class="display-data-label">Usuario</span>
    <span class="display-data-label">Correo eléctronico</span>
    <span class="display-data-label">Articulo</span>
    <span class="display-data-label">Tipo de usuario</span>
    <span class="display-data-label">Fecha de acceso</span>
    <div class="separator"></div>
</div>

@foreach($articles_user as $article_user)
<div class="info-db access">
    <span id="id" class="display-data">{{$article_user->id}}</span>
    <span class="display-data">{{$article_user->name}}</span>
    <span class="display-data">{{$article_user->email}}</span>
    <span class="display-data">{{$article_user->title}}</span>
    <span class="display-data">
        @if ($article_user->type === 'reader')
        Lector
        @elseif ($article_user->type === 'author')
        Autor
        @elseif ($article_user->type === 'moderator')
        Moderador
        @elseif ($article_user->type === 'administrator')
        Administrador
        @else
        No se ha identificado el tipo del usuario
        @endif
    </span>
    <span class="display-data">{{$article_user->created_at}}</span>
    <form hidden action="{{ route('access') }}" method="GET">
        <button class="edit-btn">
            <i class='bx bx-rotate-right'></i>
            EDITAR
        </button>
    </form>
</div>
@endforeach
@endsection

@section('paginate')
{{ $articles_user->links('vendor.pagination.custom') }}
@endsection