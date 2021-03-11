<?php


class Fruit{
    public $name;
    public $color;
    public $typee;

    public function __construct($name,$type){
        $this->name = $name;
        $this->typee = $type;
    }
    function set_name($name){
    $this->name = $name;
    }

    function get_name(){
        return $this->name;
    }
}

class Type extends Fruit{
    function message(){
        echo "{$this->name} is a kind of {$this->typee}";
    }
}

$ubas = new Type('ubas','berries');
$ubas->message();



//ANG GWAPO NI REYNAN!!!!!!!!!
?>