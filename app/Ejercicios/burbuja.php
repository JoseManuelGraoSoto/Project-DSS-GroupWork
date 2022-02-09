<?php
function swap(&$elem1, &$elem2) {
    $temp = $elem1;
    $elem1 = $elem2;
    $elem2 = $temp;
}

function ordenacionBurbuja($array) {
    for($i = 1; $i < count($array); $i++)
        for($j = 0; $j < (count($array) - $i); $j++) 
            if($array[$j] > $array[$j + 1])
                swap($array[$j], $array[$j+1]);

    return $array;
}

    print_r(ordenacionBurbuja([2, 1, 4, 3]));
?>