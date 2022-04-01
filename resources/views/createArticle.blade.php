<!DOCTYPE html>
<html>
    <body class="antialiased">
        <div>
            <form action="{{url('createArticle/')}}" method="POST">
                @csrf
                <label for="id_usuario">Id usuario:</label>
                <input type="number" name="id_usuario" id="id_usuario">
                <br>

                <label for="title">Título:</label>
                <input type="text" name="title" id="title">
                <br>
                <label for="category">Categoría:</label>
                <input type="text" name="category" id="category">
                <br>
                <label for="valoration">Valoración:</label>
                <input type="number" step=0.1 name="valoration" id="valoration">
                <br>
                <label for="content">Contenido:</label>
                <input type="text" name="content" id="content">
                <br>
                <button type="submit">Enviar</button>
            </form> 
        </div>
    </body>
</html>
