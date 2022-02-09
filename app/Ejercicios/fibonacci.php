<?php
function fibonacci($n) {
    $result = null;

    if($n == 0)
        return 0;
    elseif($n == 1)
        return 1;
    elseif($n > 1)
        return fibonacci($n - 1) + fibonacci($n - 2);
    else
        return $result;
}

    echo fibonacci(4), "\n";
    echo fibonacci(1), "\n";
    echo fibonacci(-1), "\n";
?>