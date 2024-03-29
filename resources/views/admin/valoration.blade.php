@extends('layouts.adminDB')

@section('text-inputs')
<input type="text" name="title" id="title" placeholder="Titulo del artículo">
<input type="text" name="email" id="email" placeholder="Email del usuario">
@endsection

@section('valorations-nav')
<div class="nav-item selected flex-container flex-aligned-center">
    <i class='bx bxs-star'></i>
    <span class="nav-label">Valoraciones</span>
</div>
@endsection

@section('main-buttons')
<button id="delete-btn" style="text-decoration: none;">
    <i class='bx bx-trash'></i>
    ELIMINAR VALORACIÓN
</button>

<a href="{{ route('valoration.createForm') }}" style="text-decoration: none;">
    <i class='bx bx-plus'></i>
    AÑADIR VALORACIÓN
</a>
@endsection

@section('display')
<div class="upper-separator valoration">
    <span class="display-data-label">ID</span>
    <span class="display-data-label">Artículo</span>
    <span class="display-data-label">Usuario</span>
    <span class="display-data-label">Valoración</span>
    <span class="display-data-label">Tipo Usuario</span>
    <span class="display-data-label">Fecha de creación</span>
    <div class="separator"></div>
</div>

@foreach($valorations as $valoration)
<div class="info-db valoration">
    <span id="id" class="display-data">{{$valoration->id}}</span>
    <span class="display-data">{{$valoration->title}}</span>
    <span class="display-data">{{$valoration->email}}</span>
    <span class="display-data">{{$valoration->value}}</span>
    <span class="display-data">
        @if ($valoration->type == 'reader')
        Lector
        @elseif ($valoration->type == 'author')
        Autor
        @elseif ($valoration->type == 'moderator')
        Moderador
        @elseif ($valoration->type == 'administrator')
        Administrador
        @else
        No se ha identificado el tipo del usuario
        @endif
    </span>
    <span class="display-data">{{$valoration->created_at}}</span>
    <form action=" {{ route('valoration.updateForm') }}" method="GET">
        <input type="hidden" name="valoration_id" value="{{$valoration->id}}">
        <button class="edit-btn">
            <i class='bx bx-rotate-right'></i>
            EDITAR
        </button>
    </form>
</div>

@endforeach
@endsection

@section('paginate')
{{ $valorations->links('vendor.pagination.custom') }}
@endsection