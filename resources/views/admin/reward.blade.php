@extends('layouts.adminDB')

@section('text-inputs')
<input type="text" name="user" id="user" placeholder="Titulo del artículo">
<input type="text" name="name" id="name" placeholder="Nombre del usuario">
@endsection

@section('rewards-nav')
<div class="nav-item selected container flex-aligned-center">
    <i class='bx bxs-trophy' ></i>
    <span class="nav-label">Recompensas</span>
</div>
@endsection

@section('user-type')
<div class="user-type container flex-vertical flex-aligned-center">
    <div class="types container">
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
<button>
    <i class='bx bx-trash'></i>
    ELIMINAR RECOMPENSAS
</button>

<button>
    <i class='bx bx-rotate-right'></i>
    MODIFICAR RECOMPENSA
</button>

<button>
    <i class='bx bx-plus'></i>
    AÑADIR RECOMPENSA
</button>
@endsection