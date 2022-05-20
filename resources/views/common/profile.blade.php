@extends('layouts.general')

@section('body-section')

<div class="container mt-3 pt-5">
    <div class="row gutters-sm">
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="border border-2 border-primary rounded-circle" width="150">
                        <div class="mt-3">
                            <h4>Adrián Roselló</h4>
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
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <a href="#" class="text-decoration-none">
                                <h6>Artículo 1</h6>
                            </a>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <a href="#" class="text-decoration-none">
                                <h6>Artículo 2</h6>
                            </a>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <a href="#" class="text-decoration-none">
                                <h6>Artículo 3</h6>
                            </a>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <a href="#" class="text-decoration-none">
                                <h6>Artículo 4</h6>
                            </a>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <a href="#" class="text-decoration-none">
                                <h6>Artículo 5</h6>
                            </a>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <a href="#" class="text-decoration-none">
                                <h6>Artículo 6</h6>
                            </a>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <a href="#" class="text-decoration-none">
                                <h6>Artículo 7</h6>
                            </a>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <a href="#" class="text-decoration-none">
                                <h6>Artículo 8</h6>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="container mt-3">
                <a href="#" class="btn btn-primary w-100">Añadir Artículo</a>
            </div>
            @endif
        </div>

        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <div class="row d-flex align-items-center">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Nombre</h6>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control-plaintext" id="name" placeholder="{{ Auth::user()->name }}" readonly>
                                </div>
                            </div>
                            <hr>
                            <div class="row d-flex align-items-center">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control-plaintext" id="email" placeholder="{{ Auth::user()->email }}" readonly>
                                </div>
                            </div>
                            <hr>
                            <div class="row d-flex align-items-center">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Teléfono</h6>
                                </div>
                                <div class="col-sm-9 text-accent">
                                    <input type="tel" class="form-control-plaintext" id="telephone" placeholder="{{ Auth::user()->telephone }}" readonly>
                                </div>
                            </div>
                            <hr>
                            <div id="password-fields" class="collapse">
                                <div class="row d-flex align-items-center">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Contraseña</h6>
                                    </div>
                                    <div class="col-sm-9 text-accent">
                                        <input type="password" class="form-control-plaintext" id="password" readonly>
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
                                <small>23</small>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3 ms-3">
                                <small>Valoraciones</small>
                                <small>23</small>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3 ms-3">
                                <small>Articulos visitados</small>
                                <small>12</small>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3 ms-3">
                                <small>Otra estadística</small>
                                <small>3</small>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3 ms-3">
                                <small>Otra estadística</small>
                                <small>40</small>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3 ms-3">
                                <small>Otra estadística</small>
                                <small>60</small>
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
                                <small>23</small>
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
                                <small>Otra estadística</small>
                                <small>3</small>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3 ms-3">
                                <small>Otra estadística</small>
                                <small>40</small>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3 ms-3">
                                <small>Otra estadística</small>
                                <small>60</small>
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
                                <small>23</small>
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
                                <small>Otra estadística</small>
                                <small>3</small>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3 ms-3">
                                <small>Otra estadística</small>
                                <small>40</small>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3 ms-3">
                                <small>Otra estadística</small>
                                <small>60</small>
                            </div>
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

    edit.onclick = function() {
        let form_elems = document.querySelectorAll('form input')

        Array.from(form_elems).forEach(instance => {
            instance.classList.toggle('form-control-plaintext')
            instance.classList.toggle('form-control')
            instance.toggleAttribute("readonly")
        });

        if (edit.innerHTML == "Editar") {
            edit.innerHTML = "Actualizar"
        } else {
            edit.innerHTML = "Editar"
        }
    }
</script>

@endsection