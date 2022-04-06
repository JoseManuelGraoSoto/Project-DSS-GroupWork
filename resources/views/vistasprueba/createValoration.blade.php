<!DOCTYPE html>
<html>
    <body class="antialiased">
        <div>
            <form action="{{url('createValoration/')}}" method="POST">
                @csrf
                <label for="id_usuario">Id usuario:</label>
                <input type="number" name="id_usuario" id="id_usuario">
                <br>
                <label for="article_id">Id articulo:</label>
                <input type="number" name="article_id" id="article_id">
                <br>
                <label for="value">valor:</label>
                <input type="float" name="value" id="value">
                <br>
                <label for="comment">Comentario:</label>
                <input type="text" name="comment" id="comment">
                <br>
                <button type="submit">Enviar</button>
            </form> 
        </div>
    </body>
</html>
