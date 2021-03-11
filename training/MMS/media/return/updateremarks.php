<?php

// print_r($_POST);
// return 0;
if(isset($_POST)){
    try {
        $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=mediamanagementsystem','root','admin');
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $stmt = $pdo->prepare('
        UPDATE records
        SET
        Remarks = :rem
        WHERE RecordId = :r
        ');
        $stmt->bindValue(':rem',$_POST['newremarks'],PDO::PARAM_STR);
        $stmt->bindValue(':r',$_POST['recordid'],PDO::PARAM_INT);
        $stmt->execute();
    } catch (\Throwable $th) {
        //throw $th;
    }
}
?>