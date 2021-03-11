<?php

try{
    $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=test','root','admin');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $last = $pdo->query('SELECT * FROM employees ORDER BY id DESC ');
    $lastrow =$last->fetchAll();
    // print_r($data);
    echo json_encode($lastrow);
}catch(PDOException $e){
    echo $e->getMessage();
}


?>