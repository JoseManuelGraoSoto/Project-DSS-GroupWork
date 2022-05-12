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
                            <p class="text-accent mb-1">Autor</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    Artículos
                </div>
                <div class="card-body small-card-scrollable">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <a href="#" class="text-decoration-none"><h6>Artículo 1</h6></a>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <a href="#" class="text-decoration-none"><h6>Artículo 2</h6></a>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <a href="#" class="text-decoration-none"><h6>Artículo 3</h6></a>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <a href="#" class="text-decoration-none"><h6>Artículo 4</h6></a>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <a href="#" class="text-decoration-none"><h6>Artículo 5</h6></a>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <a href="#" class="text-decoration-none"><h6>Artículo 6</h6></a>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <a href="#" class="text-decoration-none"><h6>Artículo 7</h6></a>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <a href="#" class="text-decoration-none"><h6>Artículo 8</h6></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Nombre</h6>
                        </div>
                        <div class="col-sm-9 text-accent">
                            Adrián Roselló
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Email</h6>
                        </div>
                        <div class="col-sm-9 text-accent">
                            arp129@alu.ua.es
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Teléfono</h6>
                        </div>
                        <div class="col-sm-9 text-accent">
                            (+34) 645 345 324
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12">
                            <a class="btn btn-info " target="__blank" href="#">Editar</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
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
                <div class="col-sm-6 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h6>Estadísticas Autor</h6>
                            <div class="d-flex justify-content-between align-items-center mb-3 ms-3">
                                <small>Artículos escritos</small>
                                <small>23</small>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3 ms-3">
                                <small>Veces en el podium  de puntuaciones de autores</small>
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
            </div>



        </div>
    </div>
</div>

@endsection