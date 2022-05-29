@extends('layouts.general')

@section('body-section')

<div class="container mt-3 pt-5">
    <div class="row gutters-sm">
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="{{ URL::asset('storage/users/'. $user->imagen_path); }}" alt="Admin" class="border border-2 border-primary rounded-circle" width="150">
                        <div class="mt-3">
                            <h4>{{ $user ? $user->name : Auth::user()->name}}</h4>
                            @switch(Auth::user()->type)
                            @case('author')
                            <p class="text-accent mb-1">Autor</p>
                            @break

                            @case('reader')
                            <p class="text-accent mb-1">Lector</p>
                            @break

                            @case('moderator')
                            <p class="text-accent mb-1">Moderador</p>
                            @break

                            @case('administrator')
                            <p class="text-accent mb-1">Administrador</p>
                            @break
                            @endswitch
                        </div>
                    </div>
                </div>
            </div>

            @if(Auth::user()->type == 'author' || Auth::user()->type == 'moderator')
            <div class="card mt-3">
                <div class="card-header">
                    Artículos
                </div>
                <div class="card-body small-card-scrollable">
                    <ul class="list-group list-group-flush">
                        @foreach($articles as $article)
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <a href="{{route('article', ['id' => $article->id])}}" class="text-decoration-none">
                                <h6>{{$article->title}}</h6>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="container d-flex flex-column gap-3 mt-3">
                <a href="{{route('createArticle')}}" class="btn btn-primary w-100">Añadir Artículo</a>
                <a href="{{route('deleteUser')}}" class="btn btn-danger w-100">Borrar Cuenta</a>
            </div>

            @endif
        </div>

        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-body">
                    <form action=" {{ route('updateProfile') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <div class="row d-flex align-items-center">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Nombre</h6>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control-plaintext" id="name" name="name" placeholder="{{ $user ? $user->name : Auth::user()->name }}" readonly>
                                </div>
                            </div>
                            <hr>
                            <div class="row d-flex align-items-center">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control-plaintext" id="email" name="email" placeholder="{{ $user ? $user->email : Auth::user()->email }}" readonly>
                                </div>
                            </div>
                            <hr>
                            <div class="row d-flex align-items-center">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Teléfono</h6>
                                </div>
                                <div class="col-sm-9 text-accent">
                                    <input type="tel" class="form-control-plaintext" id="telephone" name="telephone" placeholder="{{ $user ? $user->telephone : Auth::user()->telephone }}" readonly>
                                </div>
                            </div>
                            <hr>
                            <div id="password-fields" class="collapse">
                                <div class="row d-flex align-items-center">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Contraseña</h6>
                                    </div>
                                    <div class="col-sm-9 text-accent">
                                        <input type="password" class="form-control-plaintext" id="password" name="password" readonly>
                                    </div>
                                </div>
                                <hr>
                                <div class="row d-flex align-items-center">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Repetir contraseña</h6>
                                    </div>
                                    <div class="col-sm-9 text-accent">
                                        <input type="password" class="form-control-plaintext" id="confirm-password" readonly>
                                    </div>
                                </div>
                                <hr>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <button class="btn btn-primary" type="button" id="edit-btn" data-bs-toggle="collapse" data-bs-target="#password-fields" aria-expanded="false" aria-controls="password-fields">Editar</button>
                                    <button hidden class="btn btn-primary" type="submit" id="actualizar-btn" data-bs-toggle="collapse" data-bs-target="#password-fields" aria-expanded="false" aria-controls="password-fields">Actualizar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                @switch(Auth::user()->type)
                @case('author')
                @case('reader')
                @case('moderator')
                <div class="col-sm-6 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="mb-3">Estadísticas Generales</h6>
                            <div class="d-flex justify-content-between align-items-center mb-3 ms-3">
                                <small>Valoraciones</small>
                                <small>{{ ($numValorations !== null) ? $numValorations : 0}}</small>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3 ms-3">
                                <small>Articulos visitados</small>
                                <small>{{ ($numArticleAccess !== null) ? $numArticleAccess : 0}}</small>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3 ms-3">
                                <small>Meses suscrito</small>
                                <small>{{Auth::user()->numberDaysSuscripted}}</small>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3 ms-3">
                                <small>Fecha de caducidad de suscripción</small>
                                <small>{{Auth::user()->endSubscriptionDate}}</small>
                            </div>

                        </div>
                    </div>
                </div>
                @break
                @endswitch

                @switch(Auth::user()->type)
                @case('author')
                <div class="col-sm-6 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h6>Estadísticas Autor</h6>
                            <div class="d-flex justify-content-between align-items-center mb-3 ms-3">
                                <small>Artículos escritos</small>
                                <small>{{ ($numArticle !== null) ? $numArticle : 0}}</small>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3 ms-3">
                                <small>Recompensas (?)</small>
                                <small>3</small>
                            </div>

                        </div>
                    </div>
                </div>
                @break

                @case('moderator')
                <div class="col-sm-6 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h6>Estadísticas Autor</h6>
                            <div class="d-flex justify-content-between align-items-center mb-3 ms-3">
                                <small>Artículos escritos</small>
                                <small>{{ ($numArticle !== null) ? $numArticle : 0}}</small>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3 ms-3">
                                <small>Veces en el podium de puntuaciones de autores</small>
                                <small>23</small>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3 ms-3">
                                <small>Veces en la lista de puntuaciones de autores</small>
                                <small>12</small>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3 ms-3">
                                <small>Recompensas (?)</small>
                                <small>3</small>
                            </div>
                        </div>
                    </div>
                    @break
                    @endswitch
                </div>
            </div>
        </div>
    </div>

    <script>
        let edit = document.querySelector('#edit-btn')
        let actualizar = document.querySelector('#actualizar-btn')

        edit.onclick = function() {
            let form_elems = document.querySelectorAll('form input')

            Array.from(form_elems).forEach(instance => {
                instance.classList.toggle('form-control-plaintext')
                instance.classList.toggle('form-control')
                instance.toggleAttribute("readonly")
            });
            edit.toggleAttribute('hidden')
            actualizar.toggleAttribute('hidden')
        }
    </script>

    @endsection