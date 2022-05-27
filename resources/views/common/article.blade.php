@extends('layouts.general')

@section('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="{{ URL::asset('css/stars.css'); }}">
@endsection

@section('body-section')

@auth
@if(Auth::user()->type == 'moderator' && $article->acepted == 0)
<form action=" {{ route('article.acept', ['id' => $article->id]) }}" method="POST" class="container pt-5 text-end">
  @csrf
  <button type="submit" class="btn btn-primary rounded-pill py-1 px-3 shadow">ACEPTAR</button>
</form>
@endif
@endauth

<div class="d-flex justify-content-center my-5">
  <div class="shadow-lg" id="adobe-dc-view" style="width: 800px;"></div>
</div>

@auth
{{ $valoration }}
<section class="mb-5">
  <form action="{{ route('updateProfile') }}" method="POST" class="d-flex flex-column gap-3">
    @csrf
    <div class="stars container d-flex justify-content-center w-100">
      <div>
        <input class="star star-5" id="star-5" type="radio" name="star" />
        <label class="star star-5" for="star-5"></label>
        <input class="star star-4" id="star-4" type="radio" name="star" />
        <label class="star star-4" for="star-4"></label>
        <input class="star star-3" id="star-3" type="radio" name="star" />
        <label class="star star-3" for="star-3"></label>
        <input class="star star-2" id="star-2" type="radio" name="star" />
        <label class="star star-2" for="star-2"></label>
        <input class="star star-1" id="star-1" type="radio" name="star" />
        <label class="star star-1" for="star-1"></label>
      </div>
    </div>

    <div class="container text-center">
      <button type="submit" class="btn btn-primary rounded-pill py-1 px-3 shadow">VALORAR</button>
    </div>
  </form>
</section>
@endauth

<script src="https://documentcloud.adobe.com/view-sdk/main.js"></script>

<script type="text/javascript">
  document.addEventListener("adobe_dc_view_sdk.ready", function() {
    var adobeDCView = new AdobeDC.View({
      clientId: "39d623d0bca34c73ba77454131227cf3",
      divId: "adobe-dc-view"
    });
    adobeDCView.previewFile({
      content: {
        location: {
          url: "{{ URL::asset('sample.pdf'); }}"
        }
      },
      metaData: {
        fileName: "sample.pdf"
      }
    }, {
      embedMode: "IN_LINE",
      showDownloadPDF: false,
      showPrintPDF: false
    });
  });
</script>

@endsection