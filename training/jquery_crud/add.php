<?php
    // echo '<pre>';
    // // foreach($_POST['firstName'] as $key=>$val)
    // print_r($_POST['details']);
    // echo '</pre>';
    // return false;

    if(isset($_POST)){

        try{
            $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=test','root','admin');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            $stmt = $pdo->prepare('
            INSERT INTO employees(firstName, lastName, contactNumber) VALUES(:firstName, :lastName, :contactNumber)
            ');
            foreach($_POST['details'] as $key=>$val){
                // $stmt->bindValue(':firstName',$_POST['firstName'][$key], PDO::PARAM_STR);
                // $stmt->bindValue(':lastName',$_POST['lasttName'][$key], PDO::PARAM_STR);
                // $stmt->bindValue(':contactNumber',$_POST['contactNumber'][$key], PDO::PARAM_INT);
                $stmt->bindValue(':firstName',$val['firstName'], PDO::PARAM_STR);
                $stmt->bindValue(':lastName',$val['lastName'], PDO::PARAM_STR);
                $stmt->bindValue(':contactNumber',$val['contactNumber'], PDO::PARAM_INT);
                $stmt->execute();
            }

        }catch(PDOException $e){
            echo $e->getMessage();
        }




    }

?>