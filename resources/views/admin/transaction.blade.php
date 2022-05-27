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

@section('display')
<div class="upper-separator valoration">
    <span class="display-data-label">ID</span>
    <span class="display-data-label">Usuario</span>
    <span class="display-data-label">Precio</span>
    <span class="display-data-label">Concepto</span>
    <span class="display-data-label">Fecha de creación</span>
    <div class="separator"></div>
</div>

@foreach($transactions as $transaction)
<div class="info-db valoration">
    <span id="id" class="display-data">{{$transaction->id}}</span>
    <span class="display-data">{{$transaction->user->email}}</span>
    <span class="display-data">{{$transaction->price}}</span>
    <span class="display-data">{{$transaction->concept}}</span>
    <span class="display-data">{{$transaction->created_at}}</span>
</div>

@endforeach
@endsection

@section('paginate')
{{ $transaction->links('vendor.pagination.custom') }}
@endsection