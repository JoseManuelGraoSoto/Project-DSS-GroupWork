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

<div class="content-letras">
    <h2>Lectores, planes</h2>
</div>

<div class="container" style="margin-top: 5px;"> 
  <div class="d-lg-flex"> 
  <div class="card border-0 me-lg-4 mb-lg-0 mb-4"> 
      <div class="backgroundEffect"></div> 
      <div class="pic"> 
        <img class="" src="https://us.123rf.com/450wm/jackf/jackf1708/jackf170807885/84745043-joven-adolescente-mujer-leyendo-informaci%C3%B3n-en-la-computadora-port%C3%A1til-en-casa-en-la-mesa.jpg?ver=6" alt=""> 
        <div class="date"> 
          <span class="year">Anual</span>
          <span class="day">99.99€</span> 
        </div> 
      </div> 
      <div class="content"> 
        <p class="h-1 mt-3">99,99 €/año tras el periodo de la oferta</p> 
        <p class="text-muted mt-3">Lee tus artículos</p>
        <p class="text-muted mt-3">Sin Limites</p> 
        <div class="d-flex align-items-center justify-content-between mt-3 pb-3">
        <form action="{{route('pay')}}" method="GET">  
              <input hidden id="precio" name="precio" value="99.99" type="number">
              <button class="btn btn-lg btn-primary" style="height: 50px; width: 100px; font-size: 18px;">Empezar</button>
            </form>
          <div class="d-flex align-items-center justify-content-center foot"> 
            <p class="text-muted mt-3">Lector</p> 
          </div> 
        </div> 
      </div> 
    </div> 
    <div class="card border-0 me-lg-4 mb-lg-0 mb-4"> 
      <div class="backgroundEffect"></div> 
      <div class="pic"> 
        <img class="" src="https://revistasumma.com/wp-content/uploads/2019/05/libros-digitales.jpg" alt=""> 
        <div class="date"> 
          <span class="year">Trimestral</span>
          <span class="day">24.99€</span> 
        </div> 
      </div> 
      <div class="content"> 
        <p class="h-1 mt-3">24,99 €/3 meses tras el periodo de la oferta</p> 
        <p class="text-muted mt-3">Lee tus artículos</p>
        <p class="text-muted mt-3">Sin Limites</p> 
        <div class="d-flex align-items-center justify-content-between mt-3 pb-3">
        <form action="{{route('pay')}}" method="GET">  
              <input hidden id="precio" name="precio" value="24.99" type="number">
              <button class="btn btn-lg btn-primary" style="height: 50px; width: 100px; font-size: 18px;">Empezar</button>
            </form>
          <div class="d-flex align-items-center justify-content-center foot"> 
            <p class="text-muted mt-3">Lector</p> 
          </div> 
        </div> 
      </div> 
    </div> 
    
    <div class="card border-0 me-lg-4 mb-lg-0 mb-4"> 
      <div class="backgroundEffect"></div> 
      <div class="pic"> 
        <img class="" src="https://eresmama.com/wp-content/uploads/2019/11/nina-leyendo-libro-digital-768x513.jpg" alt=""> 
        <div class="date"> 
          <span class="year">Mensual</span>
          <span class="day">9.99€</span> 
        </div> 
      </div> 
      <div class="content"> 
        <p class="h-1 mt-3">9,99 €/mes tras el periodo de la oferta</p> 
        <p class="text-muted mt-3">Lee tus artículos</p>
        <p class="text-muted mt-3">Sin Limites</p> 
        <div class="d-flex align-items-center justify-content-between mt-3 pb-3">
        <form action="{{route('pay')}}" method="GET">  
              <input hidden id="precio" name="precio" value="9.99" type="number">
              <button class="btn btn-lg btn-primary" style="height: 50px; width: 100px; font-size: 18px;">Empezar</button>
            </form>
          <div class="d-flex align-items-center justify-content-center foot"> 
            <p class="text-muted mt-3">Lector</p> 
          </div> 
        </div> 
      </div> 
    </div> 
      </div> 
    </div> 
  </div> 
</div>

<div class="content-letras">
    <h2>Autores, planes</h2>
</div>

<div class="container" style="margin-top: 5px;"> 
  <div class="d-lg-flex"> 
  <div class="card border-0 me-lg-4 mb-lg-0 mb-4"> 
      <div class="backgroundEffect"></div> 
      <div class="pic"> 
        <img class="" src="https://www.danielcolombo.com/wp-content/uploads/2020/07/bill-gates-warren-buffett.jpg" alt=""> 
        <div class="date"> 
          <span class="year">Anual</span>
          <span class="day">199.99€</span> 
        </div> 
      </div> 
      <div class="content"> 
        <p class="h-1 mt-3">199,99 €/año tras el periodo de la oferta</p> 
        <p class="text-muted mt-3">Publica tus artículos</p>
        <p class="text-muted mt-3">Sin Limites</p> 
        <div class="d-flex align-items-center justify-content-between mt-3 pb-3">
        <form action="{{route('pay')}}" method="GET">  
              <input hidden id="precio" name="precio" value="199.99" type="number">
              <button class="btn btn-lg btn-primary" style="height: 50px; width: 100px; font-size: 18px;">Empezar</button>
            </form>
          <div class="d-flex align-items-center justify-content-center foot"> 
            <p class="text-muted mt-3">Autor</p> 
          </div> 
        </div> 
      </div> 
    </div> 
    <div class="card border-0 me-lg-4 mb-lg-0 mb-4"> 
      <div class="backgroundEffect"></div> 
      <div class="pic"> 
        <img class="" src="https://estaticos-cdn.prensaiberica.es/clip/6ed1ad45-e195-4cb8-aa87-1a54b82ba20c_16-9-discover-aspect-ratio_default_0.jpg" alt=""> 
        <div class="date"> 
          <span class="year">Trimestral</span>
          <span class="day">74.99€</span> 
        </div> 
      </div> 
      <div class="content"> 
        <p class="h-1 mt-3">74,99 €/3 meses tras el periodo de la oferta</p> 
        <p class="text-muted mt-3">Publica tus artículos</p>
        <p class="text-muted mt-3">Sin Limites</p> 
        <div class="d-flex align-items-center justify-content-between mt-3 pb-3">
        <form action="{{route('pay')}}" method="GET">  
              <input hidden id="precio" name="precio" value="74.99" type="number">
              <button class="btn btn-lg btn-primary" style="height: 50px; width: 100px; font-size: 18px;">Empezar</button>
            </form>
          <div class="d-flex align-items-center justify-content-center foot"> 
            <p class="text-muted mt-3">Autor</p> 
          </div> 
        </div> 
      </div> 
    </div> 
    
    <div class="card border-0 me-lg-4 mb-lg-0 mb-4"> 
      <div class="backgroundEffect"></div> 
      <div class="pic"> 
        <img class="" src="https://gestion.pe/resizer/G6Kqo_DEgpG4q2hBPQ5QqlqVHXw=/580x330/smart/filters:format(jpeg):quality(75)/arc-anglerfish-arc2-prod-elcomercio.s3.amazonaws.com/public/L2CLNBY2IZFQ5NII6AFA3HQQTA.jpg" alt=""> 
        <div class="date"> 
          <span class="year">Mensual</span>
          <span class="day">29.99€</span> 
        </div> 
      </div> 
      <div class="content"> 
        <p class="h-1 mt-3">29,99 €/mes tras el periodo de la oferta</p> 
        <p class="text-muted mt-3">Publica tus artículos</p>
        <p class="text-muted mt-3">Sin Limites</p> 
        <div class="d-flex align-items-center justify-content-between mt-3 pb-3">
        <form action="{{route('pay')}}" method="GET">  
              <input hidden id="precio" name="precio" value="29.99" type="number">
              <button class="btn btn-lg btn-primary" style="height: 50px; width: 100px; font-size: 18px;">Empezar</button>
            </form>
          <div class="d-flex align-items-center justify-content-center foot"> 
            <p class="text-muted mt-3">Autor</p> 
          </div> 
        </div> 
      </div> 
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
