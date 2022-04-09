<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="{{ URL::asset('css/styles.css'); }}">
    <title>Login</title>
</head>
<body>
    <form class="flex-container flex-aligned-center flex-center flex-vertical screenfull" action="{{ url('comprobarUser/') }}" method="PUT">
        @csrf
        <h1 class="welcome-title">
            Bienvenido de vuelta
        </h1>

        <div class="flex-container flex-vertical text-inputs">
            <input type="text" name="email" id="email" placeholder="Correo eléctronico">
            <input type="password" name="password" id="password" placeholder="Contraseña">
        </div>

        <button class="init-button">Iniciar Sesión</button>
    </form>
</body>
</html>

<script>
    
</script>
