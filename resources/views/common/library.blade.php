@extends('layouts.general')

@section('body-section')
<div class="row mt-5 w-100">
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
                <form action="{{ request()->route()->getName() }}" method="GET" class="d-flex gap-4 gap-lg-5 justify-content-center align-items-center mx-lg-5">
                    @if(Auth::user()->type == 'moderator')
                    <div class="d-flex flex-column flex-lg-row gap-4 w-100">
                        <div class="d-flex gap-4 w-100">
                            <input class="form-control border-secondary form-dark text-secondary" name="title" type="text" placeholder="Artículo" aria-label="Search">
                            <input class="form-control border-secondary form-dark text-secondary" name="author" type="text" placeholder="Autor" aria-label="Search">
                        </div>
                        <div>

                            <select class="selectpicker" title="Filtrar por estado..." multiple data-width="300px" multiple data-actions-box="true" data-style="btn-primary">
                                <option>Aceptados</option>
                                <option>No Aceptados</option>
                            </select>

                        </div>
                    </div>
                    @else
                    <input class="form-control border-secondary form-dark text-secondary" name="title" type="text" placeholder="Artículo" aria-label="Search">
                    <input class="form-control border-secondary form-dark text-secondary" name="author" type="text" placeholder="Autor" aria-label="Search">
                    @endif

                    <div>
                        <button class="btn btn-outline-accent" type="submit">Buscar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row mt-5 mx-0 w-100 d-flex justify-content-center">
    <div class="col-lg-8">
        <!-- List group-->
        <ul class="list-group shadow">
            @foreach($articles as $article)
            <!-- list group item-->
            <li class="list-group-item">
                <!-- Custom content-->
                <div class="media align-items-center d-flex justify-content-evenly flex-column  flex-lg-row p-3">
                    <div class="media-body order-2 order-lg-1 w-100">
                        <div class="d-flex justify-content-between">
                            <h5 class="mt-0 font-weight-bold mb-2">
                                <a href="{{ route('article', ['id' => $article->id]) }}" class="text-decoration-none text-primary">{{$article->title}}</a>
                            </h5>
                            <time datetime="{{ date('d/m/Y', strtotime($article->created_at)) }}" class="text-muted fst-italic">
                                {{ date('d/m/Y', strtotime($article->created_at)) }}
                            </time>
                        </div>
                        <p class="font-italic text-muted mb-0 small">{{$article->content}}</p>
                        <div class="d-flex justify-content-between align-items-end mt-4">
                            <h6 class="font-weight-bold my-2">{{$article->name}}</h6>

                            <div class="d-flex flex-column align-items-end">
                                <ul class="list-inline small">
                                    @if(($article->value*10)%10 != 0)
                                        @for($i = 0; $i < ($article->value-1); $i++)
                                            <li class="list-inline-item m-0"><i class='bx bxs-star'></i></li>
                                        @endfor
    
                                        <li class="list-inline-item m-0"><i class='bx bxs-star-half'></i></li>
                                        
                                        @for($i = 0; $i < (4-$article->value); $i++)
                                            <li class="list-inline-item m-0"><i class='bx bx-star'></i></li>
                                        @endfor
                                    @else
                                        @for($i = 0; $i < $article->value; $i++)
                                            <li class="list-inline-item m-0"><i class='bx bxs-star'></i></li>
                                        @endfor
    
                                        @for($i = 0; $i < (5-$article->value); $i++)
                                            <li class="list-inline-item m-0"><i class='bx bx-star'></i></li>
                                        @endfor
                                    @endif
                                </ul>
                                <span class="small">
                                    @if(!$article->value)
                                        0
                                    @else
                                        @if(($article->value*10)%10 != 0)
                                            {{ number_format($article->value, 1) }}
                                        @else
                                            {{ number_format($article->value, 0) }}
                                        @endif
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End -->
            </li>
            <!-- End -->
            @endforeach
            <!-- End -->
        </ul>
        <!-- End -->
    </div>
</div>

<div class="d-flex justify-content-center py-5">
    {{ $articles->links('vendor.pagination.bootstrap-4') }}
</div>
@endsection

@section('scripts')
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>
@endsection