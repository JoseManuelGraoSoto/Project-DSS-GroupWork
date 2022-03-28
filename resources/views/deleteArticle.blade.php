<!DOCTYPE html>
<html>
    <body class="antialiased">
        <div>
            @foreach($articles as $article)
                <li> {{$article->title}} </li>
                <form action="{{url('deleteArticle/'.$article->id)}}" method="POST">
                    @csrf
                    <button type="submit">Enviar</button>
                </form>
            @endforeach
            
        </div>
    </body>
</html>
 