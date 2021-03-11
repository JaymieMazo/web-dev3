<?php
session_start();
echo "<pre>";
print_r($_POST);
print_r($_SESSION['employeecode']);
echo"</pre>";
if (isset($_POST)){
    try {
        $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=mediamanagementsystem', 'root', 'admin');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $stmt = $pdo->prepare("
        UPDATE medias 
        SET StatusId = 3, 
        UpdateDate = NOW(), 
        UpdatedByCode = :usercode 
        WHERE 
        MediaId = :m
        ");
        $stmt->bindValue(':usercode', $_SESSION['employeecode'], PDO::PARAM_STR);
        $stmt->bindValue(':m',$_POST['mId'], PDO::PARAM_INT);
        
        $stmt->execute();
        echo "Heheheeh";
    } catch (PDOException $th) {
        $th->getMessage();
    }
}
    

?>