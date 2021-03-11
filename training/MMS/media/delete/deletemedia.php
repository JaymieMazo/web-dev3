<?php
// echo"<pre>";
// print_r($_POST);
// echo"</pre>";
if(isset($_POST)){

    try {
        $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=mediamanagementsystem','root','admin');
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $stmt = $pdo->prepare("UPDATE medias SET DeletedDate  = NOW(), UpdateDate = NOW() WHERE MediaId =:m");
        $stmt->bindValue(':m',$_POST['mId'],PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $th) {
        $th->getMessage();
    }
}
?>