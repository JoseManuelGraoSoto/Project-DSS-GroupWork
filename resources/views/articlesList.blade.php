<!DOCTYPE html>
<html>
    <body class="antialiased">
        <div>
            @foreach($articles as $article)
                <li> {{$article->title}} </li>
            @endforeach
        </div>
    </body>
</html>
