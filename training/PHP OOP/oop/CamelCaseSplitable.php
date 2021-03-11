<?php

trait CamelCaseSplitable
{
    public function ccsplit($str)
    {
       return preg_split('/(?=[A-Z])/',$str);
    }
    
}