<!DOCTYPE html>
<html>
    <body class="antialiased">
        <div>
            @foreach($valorations as $valoration)
                <li> {{$valoration->comment}} </li>
                <li> {{$valoration->value}} </li>
                <li> {{$valoration->user_id}} </li>
            @endforeach
        </div>
    </body>
</html>