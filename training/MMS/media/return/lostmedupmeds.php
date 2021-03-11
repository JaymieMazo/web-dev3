<?php

print_r($_POST);
if(isset($_POST)){
    try {
        $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=mediamanagementsystem','root','admin');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        // queries
        $stmt = $pdo->prepare('
        UPDATE medias SET DeletedDate = SYSDATE()
        WHERE MediaId = :m
        ');
        $stmtstat = $pdo->prepare('
        UPDATE medias SET StatusId = 7
        WHERE MediaId = :med
        ');

        // bindings
        $stmt->bindValue(':m',$_POST['mediaid'],PDO::PARAM_INT);
        $stmtstat ->bindValue(':med',$_POST['mediaid'],PDO::PARAM_INT);

        // execution
        $stmt->execute();
        $stmtstat->execute();
    } catch (PDOException $th) {
        $th->getMessage();
    }
}

?>