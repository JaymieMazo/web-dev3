<?php
 
 class parentClass
 {
     public $attr1;
     public $attr2;
     public $attr3;
     
     public function __construct()
     {
        //  $this->setattr2("test2");
         $this->setattr3("text3");
     }
     public function setattr1($i)
     {
         $this->attr1 = $i;
         
         return $this;
     }
     protected function setattr2($i)
     {
         $this->attr2 = $i;
         return $this;
     }
     private function setattr3($i)
     {
         $this->attr3 = $i;
         return $this;
     }

   

 }

 class childClass extends parentClass
 {
    public function __construct()
    {
        $this->setattr2("test2");
        // $this->setattr3("text3");
    }
 }

?>