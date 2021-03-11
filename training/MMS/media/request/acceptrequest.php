<?php
// echo "<pre>";
// print_r($_POST)
session_start();
if(isset($_POST)){
    $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=mediamanagementsystem','root','admin');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO:: FETCH_ASSOC);
    $stmt1 = $pdo->prepare('
    UPDATE medias
    SET 
    StatusId = 2
    WHERE
    Mediaid = :mid
    ');
    $stmt2 = $pdo->prepare('
    UPDATE records 
    SET 
    Remarks = "Checked Out"
    WHERE RecordId = :rid
    ');
    $stmt1->bindValue(":mid",$_POST['mediaid'],PDO::PARAM_INT);
    $stmt2->bindValue(':rid',$_POST['recordid'],PDO::PARAM_INT);
    $stmt1->execute();
    $stmt2->execute();
}
?>