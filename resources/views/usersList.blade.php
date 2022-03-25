<!DOCTYPE html>
<html>
    <body class="antialiased">
        <div>
            @foreach($users as $user)
                <li> {{$user->name}} </li>
            @endforeach
        </div>
    </body>
</html>
