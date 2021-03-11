<?php

class fibonacci{
    public function fibo(){
        $first = 0;
        $second = 1;
        echo "{$first}, " ;
        echo "{$second}, " ;

        for($i = 0;$i<8;$i++){
            $third = $first + $second;
            echo "{$third}, " ;
            $first = $second;
            $second = $third;
            
        }
    }

}

$obj = new fibonacci();
$obj->fibo();


?>