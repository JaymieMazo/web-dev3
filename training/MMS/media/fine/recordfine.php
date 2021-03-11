<?php
session_start();
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// return 0;

if (isset($_POST)) {
    try {
        $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=mediamanagementsystem', 'root', 'admin');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        // statements
        $stmt = $pdo->prepare('
        INSERT INTO finerecords
        SET
        RecordId = :rid,
        MediaId = :mid,
        Total = :fine,
        Payment = :pay,
        Extra = :ex,
        DateSettled = SYSDATE(),
        DateCreated = SYSDATE(),
        UpdatedDate = SYSDATE(),
        UpdatedByCode = :sesh
        ');

        $stmt1 = $pdo->prepare('
        UPDATE recordsdetails 
        SET Fine = NULL 
        WHERE RecordId = :r AND MediaId = :m
        ');
        // bindings
        $stmt->bindValue(':rid',$_POST['recordid'],PDO::PARAM_INT);
        $stmt->bindValue(':mid',$_POST['medid'],PDO::PARAM_INT);
        $stmt->bindValue(':fine',$_POST['fine'],PDO::PARAM_INT);
        $stmt->bindValue(':pay',$_POST['payment'],PDO::PARAM_INT);
        $stmt->bindValue(':ex',$_POST['extra'],PDO::PARAM_INT);
        $stmt->bindValue(':sesh',$_SESSION['employeecode'],PDO::PARAM_STR);

        $stmt1->bindValue(':r',$_POST['recordid'],PDO::PARAM_INT);
        $stmt1->bindValue(':m',$_POST['medid'],PDO::PARAM_INT);


        // execution
        $stmt->execute();
        $stmt1->execute();
    } catch (PDOException $th) {
        echo $th->getMessage();
    }
}
