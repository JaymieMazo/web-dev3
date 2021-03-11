<?php

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
if(isset($_POST)){
    try {
        $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=mediamanagementsystem', 'root', 'admin');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $stmt = $pdo ->prepare('
        SELECT medias.Title, COUNT(recordsdetails.MediaId) AS TOTAL FROM recordsdetails
        JOIN medias ON
        recordsdetails.MediaId = medias.MediaId
        WHERE DateIssued BETWEEN :f AND :t
        GROUP BY medias.Title 
        ORDER BY COUNT(recordsdetails.MediaId) DESC
        ');
        $stmt->bindValue(':f',$_POST['from'],PDO::PARAM_STR);
        $stmt->bindValue(':t',$_POST['to'],PDO::PARAM_STR);
        $stmt->execute();
        $getstmt = $stmt->fetchAll();
        echo json_encode($getstmt);
    } catch (PDOException $th) {
        echo $th->getMessage();
    }
}

?>