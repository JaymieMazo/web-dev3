<?php

// echo "<pre>";
// print_r($_POST);
// echo "</pre>"
if (isset($_POST)) {
    try {
        $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=mediamanagementsystem', 'root', 'admin');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $stmt = $pdo->prepare('
        SELECT RecordId, 
        recordsdetails.MediaId,
        medias.Title,
        DateIssued, 
        DateDue, 
        DateReturned, 
        Fine
        FROM recordsdetails
        JOIN medias ON
        recordsdetails.MEdiaId = medias.MediaId
        WHERE RecordId = :r
        ');
        $stmt->bindValue(':r',$_POST['recordid'],PDO::PARAM_STR);
        $stmt->execute();
        $getstmt = $stmt->fetchAll();
        echo json_encode($getstmt);
    } catch (PDOException $th) {
        echo $th->getMessage();
    }
}
