<!DOCTYPE html>
<html>
    <body class="antialiased">
        <div>
            @foreach($users as $user)
                <li> {{$user->name}} </li>
                <form action="{{url('deleteUser/'.$user->id)}}" method="POST">
                    @csrf
                    <button type="submit">Enviar</button>
                </form>
            @endforeach
            
        </div>
    </body>
</html>
