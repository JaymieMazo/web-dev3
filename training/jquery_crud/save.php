<?php
// print_r($_POST['nid']);
// print_r($_POST['nfirstName']);

// print_r($_POST['nlastName']);

// print_r($_POST['ncontactNo']);


    if(isset($_POST)){
        try{
            $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=test','root','admin');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            $stmt = $pdo->prepare('UPDATE employees SET firstName = :fName, lastName = :lname, contactNumber = :cno where id = :id');
            $stmt->bindValue(':id',$_POST['nid'],PDO::PARAM_INT);
            $stmt->bindValue(':fName',$_POST['nfirstName'],PDO::PARAM_STR);
            $stmt->bindValue(':lname',$_POST['nlastName'],PDO::PARAM_STR);
            $stmt->bindValue(':cno',$_POST['ncontactNo'],PDO::PARAM_INT);
            $stmt->execute();
            
    }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
?>