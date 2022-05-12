<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- CSS where you override -->
    <link rel="stylesheet" href="{{ URL::asset('css/subs.css'); }}">

    <title>Subscrpcion</title>
  </head>
  <body class="background_propio "> 
      
    <figure class="text-center">
    <blockquote class="blockquote text-propio" style="margin-top: 50px;">
        <h1></h1>
        <h1>Elige tu Subscripción</h1>
    
    </blockquote>
    <figcaption class="blockquote-footer text-propio" style="margin-top: 20px;">
        <h3>Lee sin límites en tu teléfono, ordenador y otros dispositivos.</h3>
    </figcaption>
    </figure>

 <!----------------------------------------------------------------------------------->
 <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel" style="margin-top: 40px;">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="{{ URL::asset('img/candado.png'); }}" class="d-block w-45" style="margin: 0 auto;">
      <h5 style="text-align: center; margin-top: 20px; color: #FFFFFF;">Forma parte de nuestra comunidad y disfruta de todas las ventajas</h5>
    </div>
    <div class="carousel-item">
      <img src="{{ URL::asset('img/line.png'); }}" class="d-block w-45" style="margin: 0 auto;">
      <h5 style="text-align: center; margin-top: 20px; color: #FFFFFF;">Lee  tus articulos favoritos sin limites y a la carta</h5>
    </div>
  </div>
</div>



<div class="container" style="margin-top: 130px;">
  <div class="row">
    <div class="flex-aligned-center col  ">
      <!-- Primera opcion -->
      <div class="card caja_propia mb-3" style="max-width: 20rem;">
        <div class="card-header" style="height: 60px">
            <h5><span class="badge oferta_propia badge-secondary">1 Mes gratis</span></h5>
        </div>
        <div class="card-body text-sec-propio ">
            <figure class="text-center">
                <h2 class="card-title">Anual</h2>
            </figure>
            <p class="card-text">100 €/año tras el periodo de la oferta</p>
            <p class="card-text">Lee tus artículos favoritos</p>
            <p class="card-text">Sin limites </p>
            <figure class="text-center">
                <button class="btn btn-lg background_propio btn-primary" type="button">Empezar</button>
            </figure>
        </div>
        </div>
    </div>
    <div class=" flex-aligned-center  col">
      <!-- Segunda opcion -->
      <div class="card caja_propia mb-3" style="max-width: 20rem;">
        <div class="card-header" style="height: 60px">
        <h5><span class="badge oferta_propia badge-secondary">1 Mes gratis</span></h5>
        </div>
        <div class="card-body text-sec-propio ">
            <figure class="text-center">
                <h2 class="card-title">Trimestral</h2>
            </figure>
            <p class="card-text">25 €/3 meses tras el periodo de la oferta</p>
            <p class="card-text">Lee tus artículos favoritos</p>
            <p class="card-text">Sin limites </p>
            <figure class="text-center">
                <button class="btn btn-lg background_propio btn-primary" type="button">Empezar</button>
            </figure>
        </div>
        </div>
    </div>
    <div class="col flex-aligned-center ">
      <!-- Tercera opcion -->
      <div class="card caja_propia mb-3" style="max-width: 20rem;">
    <div class="card-header" style="height: 60px"> </div>
    <div class="card-body text-sec-propio ">
            <figure class="text-center">
                <h2 class="card-title">Mensual</h2>
            </figure>
            <p class="card-text">9,99 €/mes tras el periodo de la oferta</p>
            <p class="card-text">Lee tus artículos favoritos</p>
            <p class="card-text">Sin limites </p>
            <figure class="text-center">
                <button class="btn btn-lg background_propio btn-primary" type="button">Empezar</button>
            </figure>
        </div>
        </div>
    </div>
  </div>
</div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>
