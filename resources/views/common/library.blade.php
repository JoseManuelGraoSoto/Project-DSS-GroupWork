@extends('layouts.general')

@section('body-section')
<div class="row mt-5">
    <div class="col-11 col-sm-10 mx-auto">
        <div class="shadow bg-terciary text-secondary p-3">
            <div class="d-flex justify-content-spaced">
                <h1>Artículos</h1>
                
                <button class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#filter" aria-expanded="false" aria-controls="filter">
                    <a data-bs-toggle="tooltip" title="Filtrar">
                        <i class='bx bx-filter text-secondary fs-2'></i>        
                    </a>
                </button>
            </div>

            <div class="collapse mt-3" id="filter">
                <form class="d-flex gap-1 gap-lg-5 justify-content-center mx-lg-5">
                    <input class="form-control border-secondary form-dark text-secondary" type="search" placeholder="Artículo" aria-label="Search">
                    <input class="form-control border-secondary form-dark text-secondary" type="search" placeholder="Autor" aria-label="Search">
                    <button class="btn btn-outline-accent" type="submit">Buscar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- 2 Ejemplos -->
<div class="row mt-5">
    <div class="col-lg-8 mx-auto">
        <!-- List group-->
        <ul class="list-group shadow">

            <!-- list group item-->
            <li class="list-group-item">
                <!-- Custom content-->
                <div class="media align-items-center d-flex justify-content-evenly flex-column  flex-lg-row p-3">
                    <div class="media-body order-2 order-lg-1">
                        <h5 class="mt-0 font-weight-bold mb-2">Awesome product</h5>
                        <p class="font-italic text-muted mb-0 small">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit fuga autem maiores necessitatibus.</p>
                        <div class="d-flex align-items-center gap-5 mt-1">
                            <h6 class="font-weight-bold my-2">Temporal</h6>
                            <ul class="list-inline small">
                                <li class="list-inline-item m-0"><i class='bx bxs-star'></i></li>
                                <li class="list-inline-item m-0"><i class='bx bxs-star'></i></li>
                                <li class="list-inline-item m-0"><i class='bx bxs-star'></i></li>
                                <li class="list-inline-item m-0"><i class='bx bxs-star'></i></li>
                                <li class="list-inline-item m-0"><i class='bx bxs-star'></i></li>
                            </ul>
                        </div>
                    </div>
                    
                    <img src="https://bootstrapious.com/i/snippets/sn-cards/shoes-1_gthops.jpg" alt="Generic placeholder image" width="200" class="ml-lg-5 order-1 order-lg-2">
                </div>
                <!-- End -->
            </li>
            <!-- End -->

            <li class="list-group-item">
                <!-- Custom content-->
                <div class="media align-items-center d-flex justify-content-evenly flex-column  flex-lg-row p-3">
                    <div class="media-body order-2 order-lg-1">
                        <h5 class="mt-0 font-weight-bold mb-2">Awesome product</h5>
                        <p class="font-italic text-muted mb-0 small">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit fuga autem maiores necessitatibus.</p>
                        <div class="d-flex align-items-center gap-5 mt-1">
                            <h6 class="font-weight-bold my-2">Temporal</h6>
                            <ul class="list-inline small">
                                <li class="list-inline-item m-0"><i class='bx bxs-star'></i></li>
                                <li class="list-inline-item m-0"><i class='bx bxs-star'></i></li>
                                <li class="list-inline-item m-0"><i class='bx bxs-star'></i></li>
                                <li class="list-inline-item m-0"><i class='bx bxs-star'></i></li>
                                <li class="list-inline-item m-0"><i class='bx bxs-star'></i></li>
                            </ul>
                        </div>
                    </div>
                    
                    <img src="https://bootstrapious.com/i/snippets/sn-cards/shoes-1_gthops.jpg" alt="Generic placeholder image" width="200" class="ml-lg-5 order-1 order-lg-2">
                </div>
                <!-- End -->
            </li>
            <!-- End -->

        </ul>
        <!-- End -->
    </div>
</div>
@endsection