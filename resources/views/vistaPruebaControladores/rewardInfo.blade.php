<!DOCTYPE html>
<html>
    <body class="antialiased">
        <div>
            Points: {{$reward->points}}
            <br>
            Fecha: {{$reward->month}}
            <br>
            EsModerador: {{$reward->isModerator}} 
            <br>
            ¿Aceptado? {{$article->acepted}} 
            <br>
            Id Autor: {{$article->user_id}} 
        </div>
    </body>
</html>