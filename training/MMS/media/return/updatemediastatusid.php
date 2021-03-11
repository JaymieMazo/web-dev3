<?php

// print_r($_POST);
// return 0;
if(isset($_POST)){
    try {
        $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=mediamanagementsystem','root','admin');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        // queries
        $stmt = $pdo->prepare('
        UPDATE medias
        SET
        StatusId = 1
        WHERE MediaId = :m
        ');

        $stmt1 = $pdo->prepare('
        UPDATE recordsdetails
        SET
        DateReturned = CURDATE()
        WHERE RecordId = :1r
        AND MediaId = :1m
        ');

        // binding
        $stmt->bindValue(':m',$_POST['mediaid'], PDO::PARAM_INT);

        $stmt1->bindValue(':1r',$_POST['medrecordid'],PDO::PARAM_INT);
        $stmt1->bindValue(':1m',$_POST['mediaid'], PDO::PARAM_INT);

        // execution
        $stmt->execute();        //uncomment later
        $stmt1->execute();       //uncomment later
        


    } catch (PDOException $th) {
        $th->getMessage();
    }
}

?>