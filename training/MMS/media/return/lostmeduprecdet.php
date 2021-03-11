<?php

print_r($_POST);

if(isset($_POST)){
    try {
        $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=mediamanagementsystem','root','admin');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $stmt = $pdo->prepare('
        UPDATE recordsdetails
        JOIN medias
        ON 
        recordsdetails.MediaId = medias.MediaId
        SET recordsdetails.Fine = FineLost, DateReturned = CURDATE()
        WHERE RecordId = :r AND recordsdetails.MediaId = :m
        ');
        $stmt->bindValue(':r',$_POST['recordid'],PDO::PARAM_INT);
        $stmt->bindValue(':m',$_POST['mediaid'],PDO::PARAM_INT);
        $stmt->execute();
        
    } catch (PDOException $th) {
        $th->getMessage();
    }
}
?>