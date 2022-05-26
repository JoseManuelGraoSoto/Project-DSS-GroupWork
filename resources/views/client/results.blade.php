
<h3>Hola, el resultado es:</h3>

@if ($status)

    <h3>Buen trabajo, todo funciono correctamente</h3>
    <div>
    resultado es: {{ $status }}
    info: {{ $result }}
    </div>  

@else
    <h3>Algo no ha ido bien</h3>
@endif