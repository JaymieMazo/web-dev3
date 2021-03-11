<?php

class DbOption
{
    public $host;
    public $dbname;
    public $username;
    public $password;

    public function __construct($host,$dbname,$username,$password)
    {

        $this->host = $host;
        $this->dbname = $dbname;
        $this->username = $username;
        $this->password = $password;
        
    }
}

?>