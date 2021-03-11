<?php
session_start();
if(isset($_POST)){
    try {
        $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=mediamanagementsystem','root','admin');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $stmt=$pdo->prepare("
        UPDATE medias SET StatusId = 1, UpdatedByCode = '".$_SESSION['employeecode']."'
        WHERE MediaId = :a");
        $stmt->bindValue(':a',$_POST['mediaId'],PDO::PARAM_INT);
        $stmtdel=$pdo->prepare("
        UPDATE mediasonhold SET DeletedDate = NOW(), UpdatedByCode = '".$_SESSION['employeecode']."'
        WHERE Mediaid = :a
        ");
        $stmtdel->bindValue(':a',$_POST['mediaId'],PDO::PARAM_INT);
        $stmt->execute();
        $stmtdel->execute();
    } catch (PDOException $th) {
        $th->getMessage();
    }
}
?>