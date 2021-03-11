<?php

// print_r($_POST['ajfname']);
// print_r($_POST['ajlname']);
// print_r($_POST['ajcno']);

if(isset($_POST)){
    try{
        $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=test','root','admin');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        $stmt = $pdo->prepare('
        INSERT INTO employees(firstName,lastName,contactNumber)
        VALUES
        (:firstname,:lastname,:contactno)
        ');
        $stmt->bindValue(':firstname',$_POST['ajfname'],PDO::PARAM_STR);
        $stmt->bindValue(':lastname',$_POST['ajlname'],PDO::PARAM_STR);
        $stmt->bindValue(':contactno',$_POST['ajcno'],PDO::PARAM_INT);
        $stmt->execute();
        
        echo json_encode($stmt);
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
}
?>