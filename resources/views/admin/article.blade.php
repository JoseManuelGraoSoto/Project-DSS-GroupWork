@extends('layouts.adminDB')

@section('text-inputs')
<input type="text" name="title" id="title" placeholder="Titulo del artículo">
<input type="text" name="author" id="author" placeholder="Email del autor">
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
<button id="delete-btn" style="text-decoration: none;">
    <i class='bx bx-trash'></i>
    ELIMINAR ARTICULOS
</button>

<a href="{{ route('article.createForm') }}" style="text-decoration: none;">
    <i class='bx bx-plus'></i>
    AÑADIR ARTICULO
</a>
@endsection

@section('display')
<div class="upper-separator article">
    <span class="display-data-label">ID</span>
    <span class="display-data-label">Titulo</span>
    <span class="display-data-label">Autor</span>
    <span class="display-data-label">Categoría</span>
    <span class="display-data-label">¿Aceptado?</span>
    <span class="display-data-label">Fecha de creación</span>
    <span class="display-data-label">Última modificación</span>
    <div class="separator"></div>
</div>
@foreach($articles as $article)
<div class="info-db article">
    <span id="id" class="display-data">{{$article->id}}</span>
    <span class="display-data">{{$article->title}}</span>
    <span class="display-data">{{$article->user->email}}</span>
    <span class="display-data">{{$article->category}}</span>
    <span class="display-data">
        @if($article->acepted)
        Aceptado
        @else
        No Aceptado
        @endif
    </span>
    <span class="display-data">{{$article->created_at}}</span>
    <span class="display-data">{{$article->updated_at}}</span>
    <form action=" {{ route('article.updateForm') }}" method="GET">
        <input type="hidden" name="article_id" value="{{$article->id}}">
        <button class="edit-btn">
            <i class='bx bx-rotate-right'></i>
            EDITAR
        </button>
    </form>
</div>
@endforeach
@endsection

@section('paginate')
{{ $articles->links('vendor.pagination.custom') }}
@endsection