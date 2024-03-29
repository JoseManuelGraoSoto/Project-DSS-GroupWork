@extends('layouts.general')

@section('body-section')

{{-- Error messages --}}
@if (count($errors) > 0)
<div class="m-3 gap-3">
    @foreach ($errors->all() as $error)
    <div class="alert alert-accent alert-dismissible fade show shadow w-100" role="alert">
        <strong>Error: </strong> {{ $error}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endforeach
</div>
@endif-

<div class="container pt-5">
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active px-4" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Datos</button>
            <button class="nav-link px-4" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Archivo</button>
        </div>
    </nav>

    <form action="{{ route('createArticleUser') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="tab-content card shadow mt-2 py-3" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="mb-5">
                    <h1 class="ms-3 position-absolute text-secondary" style="z-index: 1;">Datos</h1>
                    <svg class="position-absolute w-100" style="height: 50px; z-index: 0;">
                        <path fill="#2D3436" d="M 0 0 H 550 L 500 50 L 0 50 L 0 0" />
                    </svg>
                </div>

                <div class="form-group d-flex flex-column p-4 gap-4">
                    <div class="d-flex gap-4">
                        <div class="container">
                            <label class="form-check-label fs-5" for="ArticleTitle">Titulo</label>
                            <input id="ArticleTitle" name="title" type="text" class="form-control" aria-label="Titulo">
                        </div>

                        <div class="container d-flex flex-column">
                            <label class="form-check-label fs-5" for="ArticleCategory">Categoría</label>
                            <select class="selectpicker w-100" id="ArticleCategory" data-live-search="true" name="category" title="Selecciona una de las siguientes...">
                                @foreach($categories as $category)
                                <option value={{$category->category}}>{{$category->category}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="container">
                        <label class="form-check-label fs-5" for="ArticleDescription">Descripción</label>
                        <textarea type="textarea" class="form-control" id="ArticleDescription" name="description" rows="8"></textarea>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <div class="mb-5">
                    <h1 class="ms-3 position-absolute text-secondary" style="z-index: 1;">PDF</h1>
                    <svg class="position-absolute w-100" style="height: 50px; z-index: 0;">
                        <path fill="#2D3436" d="M 0 0 H 550 L 500 50 L 0 50 L 0 0" />
                    </svg>
                </div>

                <div class="d-flex flex-column justify-content-center gap-3 p-4">
                    <div class="container">
                        <input type="file" name="selec-txt" class="form-control" id="ArticlePDF" accept=".pdf" />
                    </div>

                    <div class="d-flex justify-content-center">
                        <div class="shadow-lg" id="adobe-dc-view" style="width: 800px;" hidden></div>
                    </div>

                    <div class="container text-end">
                        <button id="send-btn" class="btn btn-primary px-5 disabled" type="submit">Enviar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>

<script src="https://documentcloud.adobe.com/view-sdk/main.js"></script>

<script type="text/javascript">
    $('#ArticlePDF').on("change", function() {
        var files = $("#ArticlePDF").get(0).files;
        if (files.length === 1) {
            $('#send-btn').removeClass('disabled');
            $('#adobe-dc-view').removeAttr('hidden');

            var reader = new FileReader();

            reader.onload = function(e) {
                var filePromise = Promise.resolve(e.target.result);

                var adobeDCView = new AdobeDC.View({
                    clientId: "39d623d0bca34c73ba77454131227cf3",
                    divId: "adobe-dc-view"
                });

                adobeDCView.previewFile({
                    content: {
                        promise: filePromise
                    },
                    metaData: {
                        fileName: files[0].name
                    }
                }, {
                    embedMode: "IN_LINE",
                    showDownloadPDF: false,
                    showPrintPDF: false
                });
            }

            reader.readAsArrayBuffer(files[0]);
        } else {
            $('#send-btn').addClass('disabled');
            $('#adobe-dc-view').attr('hidden', true);
        }
    });
</script>

@endsection