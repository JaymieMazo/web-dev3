<?php

print_r($_POST);
if(isset($_POST)){
    try {
        $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=mediamanagementsystem','root','admin');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $stmt = $pdo->prepare('
        UPDATE records SET Remarks = "Declined" WHERE RecordId = :r
        ');
        $stmt->bindValue(':r',$_POST['recordid'],PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $th) {
        echo $th->getMessage();
    }
    try {
        $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=mediamanagementsystem','root','admin');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $stmt = $pdo->prepare('
        UPDATE recordsdetails SET DeletedDate = SYSDATE() WHERE RecordId = :r
        ');
        $stmt->bindValue(':r',$_POST['recordid'],PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $th) {
        echo $th->getMessage();
    }
}

?>