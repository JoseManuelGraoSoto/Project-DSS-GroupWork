<!DOCTYPE html>
<html>
    <body class="antialiased">
        <div>
            Titulo: {{$article->title}}
            <br>
            Categoria: {{$article->category}}
            <br>
            Valoración: {{$article->valoration}} 
            <br>
            Contenido: {{$article->content}} 
            <br>
            ¿Aceptado? {{$article->acepted}} 
            <br>
            Id Autor: {{$article->user_id}} 
        </div>
    </body>
</html>
