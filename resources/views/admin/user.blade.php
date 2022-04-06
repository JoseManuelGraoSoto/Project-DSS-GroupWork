@extends('layouts.adminDB')

@section('readers-nav')
<div class="nav-item selected container flex-aligned-center">
    <i class='bx bxs-face'></i>
    <span class="nav-label">Lectores</span>
</div>
@endsection
@section('text-inputs')
<input type="email" name="email" id="email" placeholder="Correo eléctronico">
<input type="text" name="name" id="name" placeholder="Nombre del usuario">
@endsection

@section('main-buttons')
<button>
    <i class='bx bx-trash'></i>
    ELIMINAR USUARIOS
</button>

<a href='/updateUserForm/' style='text-decoration: none'>
    <i class='bx bx-rotate-right'></i>
    MODIFICAR USUARIO
</a>

<button>
    <i class='bx bx-plus'></i>
    AÑADIR USUARIO
</button>
@endsection

@section('display')
<div>
    @foreach($users as $user)
    <li> {{$user->name}} </li>
    @endforeach
</div>

@endsection