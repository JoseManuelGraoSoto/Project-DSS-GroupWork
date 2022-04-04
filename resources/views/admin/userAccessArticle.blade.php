@extends('layouts.adminDB')

@section('text-inputs')
<input type="text" name="user" id="user" placeholder="Titulo del artículo">
<input type="text" name="name" id="name" placeholder="Nombre del usuario">
@endsection

@section('access-nav')
<div class="nav-item selected container flex-aligned-center">
    <i class='bx bxs-file-export'></i>
    <span class="nav-label">Acceso de usuarios</span>
</div>
@endsection

@section('date')
<input id="datepicker" type="text" placeholder="Fecha de acceso" />
@endsection

@section('main-buttons')
<button>
    <i class='bx bx-trash'></i>
    ELIMINAR ACCESO
</button>

<button>
    <i class='bx bx-rotate-right'></i>
    MODIFICAR ACCESO
</button>

<button>
    <i class='bx bx-plus'></i>
    AÑADIR ACCESO
</button>
@endsection

@section('display')
<div>
    @foreach($articles_user as $article_user)
    @foreach ($article_user->access as $acceso)
    <li> Usuario: {{$article_user->name}}, Articulo: {{$acceso->title}}</li>
    @endforeach
    @endforeach
</div>
@endsection