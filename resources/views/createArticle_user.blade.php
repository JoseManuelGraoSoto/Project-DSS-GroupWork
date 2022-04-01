<!DOCTYPE html>
<html>
    <body class="antialiased">
        <div>
            <form action="{{url('createArticle_user/')}}" method="POST">
                @csrf
                Id de usuario: 
                <select name="user_id">
                    @foreach($users as $user)
                        <option value={{$user->id}}>{{$user->id}}</option>
                    @endforeach
                </select>
                <br>
                Id de artículo: 
                <select name="article_id">
                    @foreach($articles as $article)
                        <option value={{$article->id}}>{{$article->id}}</option>
                    @endforeach
                </select>
                <br>
                <button type="submit">Enviar</button>
            </form> 
        </div>
    </body>
</html>
