<?php
session_start();
    if(isset($_POST)){
        $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=mediamanagementsystem','root','admin');
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $stmt = $pdo->prepare('
        UPDATE employees 
        SET 
        Address = :add, 
        ContactNumber = :cont,
        Password = :pass
        WHERE CardNumber = :cn
        ');
        $stmt->bindValue(':add',$_POST['address'],PDO::PARAM_STR) ;
        $stmt->bindValue(':cont',$_POST['contact'],PDO::PARAM_STR) ;
        $stmt->bindValue(':pass',$_POST['password'],PDO::PARAM_STR);
        $stmt->bindValue(':cn',$_SESSION['employeecode'],PDO::PARAM_STR);
        $stmt->execute();
    }
?>