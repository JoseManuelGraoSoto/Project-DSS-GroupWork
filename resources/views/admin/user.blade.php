@extends('layouts.adminDB')

@section('users-nav')
<div class="nav-item selected flex-container flex-aligned-center">
    <i class='bx bxs-face'></i>
    <span class="nav-label">Usuarios</span>
</div>
@endsection

@section('text-inputs')
<input type="text" name="email" id="email" placeholder="Correo eléctronico">
<input type="text" name="name" id="name" placeholder="Nombre del usuario">
@endsection

@section('main-buttons')
<button id="delete-btn" style="text-decoration: none;">
    <i class='bx bx-trash'></i>
    ELIMINAR USUARIOS
</button>

<a id="add-btn" href="/createUserForm" style="text-decoration: none;">
    <i class='bx bx-plus'></i>
    AÑADIR USUARIO
</a>
@endsection

@section('display')

<div class="upper-separator">
    <div class="separator"></div>
    <span class="user-data-label">ID</span>
    <span class="user-data-label">Correo eléctronico</span>
    <span class="user-data-label">Contraseña</span>
    <span class="user-data-label">Nombre</span>
    <span class="user-data-label">Tipo Usuario</span>
    <span class="user-data-label">Teléfono</span>
    <span class="user-data-label">Fecha de creación</span>
    <div class="separator"></div>
</div>

@foreach($users as $user)
<div class="user">
    <img src="{{ URL::asset('img/default.png'); }}" class="user-img" alt="Default user picture">
    <span id="id" class="user-data">{{$user->id}}</span>
    <span class="user-data">{{$user->email}}</span>
    <div class="show-container flex-container flex-center">
        <i id="show" class='bx bx-low-vision'></i>
        <div id="password">{{$user->password}}</div>
    </div>
    <span class="user-data">{{$user->name}}</span>
    <span class="user-data">
        @if ($user->type == 'reader')
        Lector
        @elseif ($user->type == 'author')
        Autor
        @elseif ($user->type == 'moderator')
        Moderador
        @elseif ($user->type == 'administrator')
        Administrador
        @else
        No se ha identificado el tipo del usuario
        @endif
    </span>
    <span class="user-data">{{$user->telephone}}</span>
    <span class="user-data">{{$user->created_at}}</span>
    <form action=" {{ url('updateUserForm/') }}" method="GET">
        <button class="edit-btn">
            <i class='bx bx-rotate-right'></i>
            EDITAR
        </button>
    </form>
</div>
@endforeach
@endsection

@section('paginate')
{{ $users->links('vendor.pagination.custom') }}
@endsection