<?php
require_once('Regular.php');
require_once('Premium.php');
require_once('index.php');
class Premium extends Telecom implements validate
{
    private $daytotal = 0;
    private $nighthtotal = 0;

    public function compute()
    {

        echo "<br>Class: Premium<br>";
        echo "Service Fee: \${$this->bill}<br>";
        $tothr = $this->mins + $this->mins2;
        echo "Hours of Call: {$tothr}<br>";
        if ($this->mins > 75) {
            $extra = $this->mins - 75;
            $extrabill = $extra * .10;
            $this->daytotal = $extrabill;
            echo "Charge(AM): \${$this->daytotal}<br>";
            // echo "Total Fee: \$$total";
        }
        if ($this->mins2 > 100) {
            $extran = $this->mins2 - 100;
            $extranbill = $extran * .05;
            $this->nighthtotal = $extranbill;
            echo "Charge(PM): \${$this->nighthtotal}<br>";
        }
        $total = $this->bill + $this->daytotal + $this->nighthtotal;
        echo "Total: \${$total}";
        echo "<br>";
    }
}
