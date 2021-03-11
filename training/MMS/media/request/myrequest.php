<?php
session_start();
if (isset($_POST)) {
    try {
        // print_r($_POST);
        $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=mediamanagementsystem', 'root', 'admin');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $stmt = $pdo->prepare('
    INSERT INTO mediasonhold (MediaId,CreatedDate,UpdatedByCode)
    SELECT MediaId,NOW(), "'.$_SESSION['employeecode'].'" FROM medias 
    WHERE MediaId = :m
    ');
        $stmt->bindValue(':m', $_POST['mediaId'], PDO::PARAM_STR);
        $stmt->execute();
    } catch (PDOException $th) {
        $th->getMessage();
    }



    
    try {
        $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=mediamanagementsystem', 'root', 'admin');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $stmt = $pdo->prepare('
        UPDATE medias
        SET StatusId = 6,
        UpdatedByCode = "' . $_SESSION['employeecode'] . '"
        WHERE medias.MediaID = :m
        ');
        $stmt->bindValue(':m',$_POST['mediaId'],PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $th) {
        $th->getMessage();
    }
}
