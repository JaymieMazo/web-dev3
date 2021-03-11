<?php

// print_r($_POST);
// return 0;
if(isset($_POST)){
    try {
        $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=mediamanagementsystem','root','admin');
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $stmt = $pdo->prepare('
        UPDATE recordsdetails 
        SET Fine = :f
        WHERE RecordId = :r
        AND MediaId = :m
        ');
        $stmt->bindValue(':f',$_POST['finelate']);
        $stmt->bindValue(':r',$_POST['recordid'],PDO::PARAM_INT);
        $stmt->bindValue(':m',$_POST['mediaid'],PDO::PARAM_INT);
        $stmt->execute();
        // print_r($stmt);
    } catch (PDOException $th) {
        $th->getMessage();
    }
}
?>