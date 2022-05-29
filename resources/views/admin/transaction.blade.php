@extends('layouts.adminDB')

@section('text-inputs')
<input type="text" name="email" id="email" placeholder="Email del usuario">
@endsection

@section('transactions-nav')
<div class="nav-item selected flex-container flex-aligned-center">
    <i class='bx bx-money-withdraw'></i>
    <span class="nav-label">Transacciónes</span>
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
        <div class="type">
            <input checked="" type="checkbox" name="readerCheckbox" id="reader-type" class="hidden-xs-up">
            <label for="reader-type" class="cbx">
                <div class="type-tooltip">
                    <span>Lector</span>
                    <i class='bx bxs-down-arrow'></i>
                </div>
            </label>
        </div>
    </div>

    <span class="type-title">Tipo de usuario</span>
</div>
@endsection

@section('display')
<div class="upper-separator transaction">
    <span class="display-data-label">ID</span>
    <span class="display-data-label">Usuario</span>
    <span class="display-data-label">Tipo de Usuario</span>
    <span class="display-data-label">Precio</span>
    <span class="display-data-label">Concepto</span>
    <span class="display-data-label">Fecha de creación</span>
    <div class="separator"></div>
</div>

@foreach($transactions as $transaction)
<div class="info-db transaction">
    <span id="id" class="display-data">{{$transaction->id}}</span>
    <span class="display-data">{{$transaction->email}}</span>
    <span class="display-data">@if ($transaction->type == 'reader')
        Lector
        @elseif ($transaction->type == 'author')
        Autor
        @elseif ($transaction->type == 'moderator')
        Moderador
        @else
        No se ha identificado el tipo del usuario
        @endif</span>
    <span class="display-data">{{$transaction->price}}</span>
    <span class="display-data">{{$transaction->concept}}</span>
    <span class="display-data">{{$transaction->created_at}}</span>
</div>

@endforeach
@endsection

@section('paginate')
{{ $transactions->links('vendor.pagination.custom') }}
@endsection