<?php

try{
    $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=mediamanagementsystem','root','admin');
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $maxcid = $pdo->query('SELECT MAX(EmployeeId) + 1 as cid FROM employees');
    // echo json_encode($maxcid);
    $fmaxid = $maxcid->fetchAll();
    echo json_encode($fmaxid);  
}       
catch(PDOException $e){
    echo $e->getMessage();
}
