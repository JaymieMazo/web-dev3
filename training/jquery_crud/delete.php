<?php
// print_r($_POST['id']);
// return false;
if(isset($_POST)){
    try{
        $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=test','root','admin');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        $stmt = $pdo->prepare('DELETE FROM employees where id = :id');
        $stmt->bindValue(':id',$_POST['id'],PDO::PARAM_INT);
        $stmt->execute();
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}

?>