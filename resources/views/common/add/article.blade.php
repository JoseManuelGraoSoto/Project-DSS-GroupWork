@extends('layouts.general')

@section('body-section')
<div class="container pt-5">
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active px-4" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                type="button" role="tab" aria-controls="nav-home" aria-selected="true">Datos</button>
            <button class="nav-link px-4" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Archivo</button>
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
                            <select class="selectpicker w-100" id="ArticleCategory" data-live-search="true"
                                title="Selecciona una de las siguientes...">
                                <option data-tokens="1">Categoría 1</option>
                                <option data-tokens="2">Categoría 2</option>
                                <option data-tokens="3">Categoría 3</option>
                            </select>
                        </div>
                    </div>

                    <div class="container">
                        <label class="form-check-label fs-5" for="ArticleDescription">Descripción</label>
                        <textarea type="textarea" class="form-control" id="ArticleDescription" name="description"
                            rows="8"></textarea>
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
                        <input type="file" name="selec-txt" class="form-control" id="ArticlePDF" accept="text/plain, .pdf, .doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" />
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
<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>

<script>
let uploadFile = document.getElementById('ArticlePDF')

uploadFile.onchange = function() {
    document.getElementById('adobe-dc-view').toggleAttribute('hidden')
};
</script>

<script src="https://documentcloud.adobe.com/view-sdk/main.js"></script>

<script type="text/javascript">
let doOnLoad = function() {
    let prueba = document.getElementById('send-btn')
    prueba.classList.remove('disabled')
}

let doOnFail = function() {
    Error()
}

document.addEventListener("adobe_dc_view_sdk.ready", function() {
    var adobeDCView = new AdobeDC.View({
        clientId: "39d623d0bca34c73ba77454131227cf3",
        divId: "adobe-dc-view"
    });
    adobeDCView.previewFile({
        content: {
            location: {
                url: "{{  URL::asset('storage/articles/prueba.pdf');  }}"
            }
        },
        metaData: {
            fileName: "prueba.pdf",
        }
    }, {
        embedMode: "IN_LINE",
        showDownloadPDF: false,
        showPrintPDF: false
    }).then(doOnLoad(), doOnFail())
});
</script>
@endsection