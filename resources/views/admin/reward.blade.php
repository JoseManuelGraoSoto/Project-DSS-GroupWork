@extends('layouts.adminDB')

@section('text-inputs')
<input type="text" name="email" id="email" placeholder="Email del usuario">
<input type="text" name="name" id="name" placeholder="Nombre del usuario">
@endsection

@section('rewards-nav')
<div class="nav-item selected flex-container flex-aligned-center">
    <i class='bx bxs-trophy'></i>
    <span class="nav-label">Recompensas</span>
</div>
@endsection

@section('user-type')
<div class="user-type flex-container flex-vertical flex-aligned-center">
    <div class="types flex-container">
        <div class="type">
            <input checked="" type="checkbox" name="authorCheckbox" id="author-type" class="hidden-xs-up">
            <label for="author-type" class="cbx">
                <div class="type-tooltip">
                    <span>Autor</span>
                    <i class='bx bxs-down-arrow'></i>
                </div>
            </label>
        </div>
        <div class="type">
            <input checked="" type="checkbox" name="moderatorCheckbox" id="moderator-type" class="hidden-xs-up">
            <label for="moderator-type" class="cbx">
                <div class="type-tooltip">
                    <span>Moderador</span>
                    <i class='bx bxs-down-arrow'></i>
                </div>
            </label>
        </div>
    </div>

    <span class="type-title">Tipo de recompensa</span>
</div>
@endsection

@section('date')
<input readonly id="datepicker" type="text" placeholder="Fecha de registro" />
@endsection

@section('main-buttons')
<button id="delete-btn" style="text-decoration: none;">
    <i class='bx bx-trash'></i>
    ELIMINAR RECOMPENSAS
</button>

<a href="{{ route('reward.createForm') }}" style="text-decoration: none;">
    <i class='bx bx-plus'></i>
    AÑADIR RECOMPENSA
</a>
@endsection

@section('display')
<div class="upper-separator reward">
    <span class="display-data-label">ID</span>
    <span class="display-data-label">Correo eléctronico</span>
    <span class="display-data-label">Nombre</span>
    <span class="display-data-label">Puntos</span>
    <span class="display-data-label">Tipo Recompensa</span>
    <span class="display-data-label">Fecha de registro</span>
    <div class="separator"></div>
</div>

@foreach($rewards as $reward)
<div class="info-db reward">
    <span id="id" class="display-data">{{$reward->id}}</span>
    <span class="display-data">{{$reward->email}}</span>
    <span class="display-data">{{$reward->name}}</span>
    <span class="display-data">{{$reward->points}}</span>
    <span class="display-data">
        @if($reward->isModerator)
        Moderador
        @else
        Autor
        @endif
    </span>
    <span class="display-data">{{$reward->created_at}}</span>
    <form action=" {{ route('reward.updateForm') }}" method="GET">
        <input type="hidden" name="reward_id" value="{{$reward->id}}">

        <button class="edit-btn">
            <i class='bx bx-rotate-right'></i>
            EDITAR
        </button>
    </form>
</div>
@endforeach
@endsection

@section('paginate')
{{ $rewards->links('vendor.pagination.custom') }}
@endsection