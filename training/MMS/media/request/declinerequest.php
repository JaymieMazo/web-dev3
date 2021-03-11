<?php
// return 0;
if (isset($_POST)) {
    try {
        $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=mediamanagementsystem','root','admin');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $stmt = $pdo->prepare('
        UPDATE medias SET StatusId = 1 WHERE MediaId = :m
        ');
        $stmt->bindValue(':m',$_POST['mediaid'],PDO::PARAM_INT);
        $stmt->execute();
    } catch (\Throwable $th) {
        //throw $th;
    }
    
}
?>