<?php
require_once('Regular.php');
require_once('Premium.php');
require_once('index.php');
class Regular extends Telecom implements validate{

public function compute(){
    
        echo "Class: Regular<br>";
        echo "Service Fee: \${$this->bill}<br>";
        echo "Hours of Call: {$this->mins}<br>";
        if ($this->mins > 50){
            $extra = $this->mins - 50;
            $extrabill = $extra * .20;
            $total = $extrabill + $this->bill;
            echo "Add. Charge: \${$extrabill}<br>";
            echo "Total Fee: \$$total";
            echo "<br>";
        }
        else{
            echo "Total Fee: {$this->mins}";
            echo "<br>";
        }
}

}
