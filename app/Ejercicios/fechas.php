<?php
function proximoMes() {
    $time = new DateTime('NOW');
    $time->add(new DateInterval("P1M"));
    return date_format($time, 'd/m/Y');
}

    echo proximoMes(), "\n";
?>