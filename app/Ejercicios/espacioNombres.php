<?php
    require_once("clases.php");
    use fibonacci_class\Fibonacci;

    $fibonacci = new Fibonacci();

    $fibonacci->imprimirSecuencia();
    $fibonacci->fibonacci(20);
    $fibonacci->imprimirSecuencia();
?>