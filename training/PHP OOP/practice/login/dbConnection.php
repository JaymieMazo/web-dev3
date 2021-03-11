<?php

 class DBConn {
    private $host = 'localhost';
    private $username = 'root';
    private $password = 'admin';
    private $database = 'login_db';
 
    protected $connection;
 
    public function __construct(){
 
        if (!isset($this->connection)) {
 
            // $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);
            $this->connection = new PDO("mysql:host={$this->host};dbname={$this->database}","{$this->username}","{$this->password}");
            
            if (!$this->connection) {
                echo 'Cannot connect to database server';
                exit;
            }            
        }    
 
        return $this->connection;
    }
 }
?>