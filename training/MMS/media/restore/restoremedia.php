<?php

// echo $_POST['mediaId'];

if(isset($_POST)){

    try {
        $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=mediamanagementsystem','root','admin');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $stmt = $pdo->prepare('UPDATE medias SET StatusId = 1, UpdateDate = NOW() WHERE MediaId = :m');
        $stmt->bindValue(':m',$_POST['mediaId']);
        $stmt->execute();
    } catch (PDOException $th) {
        $th->getMessage();
    }
}

?>