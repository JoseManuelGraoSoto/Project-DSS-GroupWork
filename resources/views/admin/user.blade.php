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

<a id="add-btn" href="{{ route('user.createForm') }}" style="text-decoration: none;">
    <i class='bx bx-plus'></i>
    AÑADIR USUARIO
</a>
@endsection

@section('display')

<div class="upper-separator user">
    <div class="separator"></div>
    <span class="display-data-label">ID</span>
    <span class="display-data-label">Correo eléctronico</span>
    <span class="display-data-label">Contraseña</span>
    <span class="display-data-label">Nombre</span>
    <span class="display-data-label">Tipo Usuario</span>
    <span class="display-data-label">Teléfono</span>
    <span class="display-data-label">Nº de días</span>
    <span class="display-data-label">Fecha de creación</span>
    <div class="separator"></div>
</div>

@foreach($users as $user)
<div class="info-db user">
    <!-- <img src="getVideo()" id="foto" class="user-img" alt="Default user picture"> -->
    <!-- <img src="{{ $user->imagen_path }}" id="foto" class="user-img" alt="Default user picture"> -->
    <img src="{{ URL::asset('storage/users/'. $user->imagen_path); }}" id="foto" class="user-img" alt="Default user picture">
    <p>{{$user->imagen_path}}</p>
    <span id="id" class="display-data">{{$user->id}}</span>
    <span class="display-data">{{$user->email}}</span>
    <div class="show-container flex-container flex-center">
        <i id="show" class='bx bx-low-vision'></i>
        <div id="password">{{$user->password}}</div>
    </div>
    <span class="display-data">{{$user->name}}</span>
    <span class="display-data">
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
    <span class="display-data">{{$user->telephone}}</span>
    <span class="display-data">{{$user->numberDaysSuscripted}}</span>
    <span class="display-data">{{$user->created_at}}</span>
    <form action=" {{ route('user.updateForm') }}" method="GET">
        <input type="hidden" name="user_id" value="{{$user->id}}">
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