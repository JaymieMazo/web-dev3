<?php
// foreach($_POST as $key=>$val)
// print_r($val);

// print_r($_POST['customerCard']);
if(isset($_POST)){
    try{
        $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=mediamanagementsystem;','root','admin');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        $stmt = $pdo->prepare('
        INSERT INTO customers 
        (CardNumber,Name,Address,ContactNumber,BirthDate,Username,Password,CreatedDate,UpdatedByCode)
        VALUES
        (:cn,:name,:add,:cno,:bday,:uname,:pwd,NOW(),:upbycode)
        ');
        $stmt->bindValue(':cn',$_POST['customerCard']);
        $stmt->bindValue(':name',$_POST['customerName']);
        $stmt->bindValue(':add',$_POST['customerAddress']);
        $stmt->bindValue(':cno',$_POST['customerContactNo']);
        $stmt->bindValue(':bday',$_POST['customerBirthDate']);
        $stmt->bindValue(':uname',$_POST['customerUsername']);
        $stmt->bindValue(':pwd',$_POST['customerPassword']);
        $stmt->bindValue('upbycode',$_POST['customerCard']);
        $stmt->execute();

        echo json_encode($stmt);
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
}

?>