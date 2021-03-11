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
        $stmt = $pdo->prepare('
        INSERT INTO employees (
            CardNumber,
            BranchId,
            UserLevelId,
            Name,
            Address,
            ContactNumber,
            BirthDate,
            Username,
            Password,
            CreatedDate,
            UpdatedByCode
        ) VALUES (
            :cn,
            :bn,
            :lvl,
            :n,
            :ad,
            :cnt,
            :bday,
            :un,
            :ps,
            SYSDATE(),
            :ubc
        )
        ');
        $stmt->bindValue(':cn',$_POST['cardnumber'],PDO::PARAM_STR);
        $stmt->bindValue(':bn',$_POST['branch'],PDO::PARAM_INT);
        $stmt->bindValue(':lvl',$_POST['level'],PDO::PARAM_INT);
        $stmt->bindValue(':n',$_POST['name'],PDO::PARAM_STR);
        $stmt->bindValue(':ad',$_POST['address'],PDO::PARAM_STR);
        $stmt->bindValue(':cnt',$_POST['contact'],PDO::PARAM_STR);
        $stmt->bindValue(':bday',$_POST['birthdate']);
        $stmt->bindValue(':un',$_POST['username'],PDO::PARAM_STR);
        $stmt->bindValue(':ps',$_POST['password'],PDO::PARAM_STR);
        $stmt->bindValue(':ubc',$_SESSION['employeecode'],PDO::PARAM_STR);
        $stmt->execute();







        

        


    } catch (PDOException $th) {
        echo $th->getMessage();
    }
}
