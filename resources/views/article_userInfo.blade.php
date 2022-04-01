<!DOCTYPE html>
<html>
    <body class="antialiased">
        <div>
            @foreach($article_user as $article)
                -------------------------------
                <br>
                Acceso artículo nº {{$article->id}}
                <br>
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
            @endforeach
        </div>
    </body>
</html>
