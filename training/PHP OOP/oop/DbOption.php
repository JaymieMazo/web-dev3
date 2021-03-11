<?php

class DbOption
{
    public $host,$dbname,$username,$password;

    public function __construct($host,$dbname,$username,$password)
    {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->username = $username;
        $this->password = $password;
    }

    
}