<!DOCTYPE html>
<html>
    <body class="antialiased">
        <div>
            @foreach($articles_user as $article_user)
                @foreach ($article_user->access as $acceso)
                    <li> Usuario: {{$article_user->name}}, Articulo: {{$acceso->title}}</li>
                @endforeach
            @endforeach
        </div>
    </body>
</html>
