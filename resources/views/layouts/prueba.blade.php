<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ URL::asset('css/styles.css'); }}">
    @yield('header')
    <title>Document</title>
</head>

<body>
    <form action="/prueba" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="block">
            <input type="file" class="block shadow-4xl mb-10 p-2 w-80 italic placeholder-gray-400" name="image">
    </form>
    <button type="submit" class="bg-green-500 block shadow-5xl mb-10 p-2 w-80 uppercase font-bold">
        Submit
    </button>
</body>

</html> 
