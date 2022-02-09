<?php
function divide($numerador, $denominador) {
    $result = null;

    if($denominador != 0)
        $result = $numerador / $denominador;

    return $result;
}
    echo divide(4, 2), "\n";
    echo divide(4, 0), "\n";
?>