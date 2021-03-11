<?php

class exer1
{
    public function displaystr()
    {
        echo 'My Class has initiated!';
    }
}


class exer2
{
    public function introduce($nickname)
    {
        echo "Hello All, I am {$nickname}";
    }
}


class exer3
{
    // public $ans;
    public $sum;
    public function factorial($inp)
    {
        $this->sum = $inp * ($inp - 1);
        for ($i = $inp - 1; $i > 1; $i--) {
            $this->sum = $this->sum * ($i - 1);
        }
        echo "Factorial of {$inp}: {$this->sum}<br>";
    }
}

class exer4
{
    public function compute($num1)
    {
       return $num1 <= 51 ? 51 - $num1 : ($num1 - 51) * 3;
    }
}


class exer5{
    public function compute($num){
        if(abs($num - 100) <= 10 || abs($num - 200) <= 10 ){
            return true;
        }
        return false;
    }
}

// no5
$no5 = new exer5();
var_dump($no5->compute(90));
var_dump($no5->compute(194));
var_dump($no5->compute(15));



//no4
// $no4 = new exer4();
// echo $no4->compute(53);


// no3
// $no3 = new exer3;
// $no3->factorial(10);



// no2
// $no2 = new exer2();
// $no2->introduce('Mark');



// no 1
// $no1 = new exer1();
// $no1->displaystr();
