<?php
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
session_start();
if(isset($_POST)){
    try {
        $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=mediamanagementsystem','root','admin');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $stmt = $pdo->prepare('
        UPDATE 
        mediasonhold 
        SET DeletedDate = NOW() 
        WHERE HoldId = :h
        ');
        $stmt->bindValue(':h',$_POST['holdid'],PDO::PARAM_STR);
        $stmt->execute ();
    } catch (PDOException $th) {
        $th->getMessage();
    }
}
?>