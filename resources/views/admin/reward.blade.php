@extends('layouts.adminDB')

@section('text-inputs')
<input type="text" name="user" id="user" placeholder="Titulo del artículo">
<input type="text" name="name" id="name" placeholder="Nombre del usuario">
@endsection

@section('rewards-nav')
<div class="nav-item selected flex-container flex-aligned-center">
    <i class='bx bxs-trophy' ></i>
    <span class="nav-label">Recompensas</span>
</div>
@endsection

@section('user-type')
<div class="user-type flex-container flex-vertical flex-aligned-center">
    <div class="types flex-container">
        <div class="type">
            <input checked="" type="checkbox" id="author-type" class="hidden-xs-up">
            <label for="author-type" class="cbx">
                <div class="type-tooltip">
                    <span>Autor</span>
                    <i class='bx bxs-down-arrow'></i>
                </div>
            </label>
        </div>
        <div class="type">
            <input checked="" type="checkbox" id="moderator-type" class="hidden-xs-up">
            <label for="moderator-type" class="cbx">
                <div class="type-tooltip">
                    <span>Moderador</span>
                    <i class='bx bxs-down-arrow'></i>
                </div>
            </label>
        </div>
    </div>

    <span class="type-title">Tipo de usuario</span>
</div>
@endsection

@section('main-buttons')
<a href="/" style="text-decoration: none;">
    <i class='bx bx-trash'></i>
    ELIMINAR RECOMPENSAS
</a>

<a href="/" style="text-decoration: none;">
    <i class='bx bx-rotate-right'></i>
    MODIFICAR RECOMPENSA
</a>

<a href="/" style="text-decoration: none;">
    <i class='bx bx-plus'></i>
    AÑADIR RECOMPENSA
</a>
@endsection