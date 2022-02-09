<?php namespace fibonacci_class;

class Fibonacci {
    private $sequence = array();

    function __construct() {
        for($n = 0; $n < 10; $n++)
            $this->sequence[$n] = $this->fibonacci($n);
    }

    public function imprimirSecuencia() {
        echo implode(", ", $this->sequence), "\n";
    }

    public function fibonacci($n) {
        if($this->sequence[$n] ?? null)
            return $this->sequence[$n];

        $result = null;
    
        if($n == 0) {
            return 0;
        } elseif($n == 1) {
            return 1;
        } elseif($n > 1) {
            $fib = $this->fibonacci($n - 1) + $this->fibonacci($n - 2);
            $this->sequence[$n] = $fib;
            return $fib;
        } else {
            return $result;
        }
    }
}
?>