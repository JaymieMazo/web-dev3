<?php

class character {
    public $hero;
    private $base_atk;
    private $base_def;

    // public function __construct($hero, $base_atk, $base_def)
    public function __construct()
    {
        
    }
    public function get_det(){
        echo "Hero: {$this->hero}<br>";
        echo "ATK: {$this->base_atk}<br>";
        echo "DEF: {$this->base_def}<br>";
    }

    public function setAttibutes($hero, $base_atk, $base_def){
        $this->hero = $hero;
        $this->base_atk = $base_atk;
        $this->base_def = $base_def;
    }

}

// $mirana = new character('Mirana','15','10');
$mirana =  new character;
$qop =  new character;
$mirana->setAttibutes('Mirana','15','10');
$qop->setAttibutes('Queen of Pain','8','2');
$mirana->get_det();
$qop->get_det();



// $mirana->base_atk = 50;
// $mirana->base_def = 10;



?>