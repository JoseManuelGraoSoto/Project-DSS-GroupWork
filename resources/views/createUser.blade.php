<!DOCTYPE html>
<html>
    <body class="antialiased">
        <div>
            <form action="{{url('createUser/')}}" method="POST">
                @csrf
                <label for="name">Nombre:</label>
                <input type="text" name="name" id="name">
                <br>
                <label for="type">Tipo usuario:</label>
                <input type="text" name="type" id="type">
                <br>
                <label for="email">Correo electrónico:</label>
                <input type="email" name="email" id="email">
                <br>
                <label for="password">Contraseña:</label>
                <input type="password" name="password" id="password">
                <br>
                <label for="telephone">Teléfono:</label>
                <input type="tel" name="telephone" id="telephone">
                <button type="submit">Enviar</button>
            </form> 
        </div>
    </body>
</html>
