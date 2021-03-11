<?php

trait CamelCase
{
    public function camelsplit($str)
    {
       return preg_split('/(?=[A-Z])/',$str);
    }
    
}