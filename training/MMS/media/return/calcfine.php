<?php

try {
    $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=mediamanagementsystem', 'root', 'admin');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $stmt = $pdo->query('
    SELECT RecordId, medias.MediaId,medias.Title, medias.FineLate, IF(recordsdetails.DateDue < CURDATE(),"set fine","good") as Status
    FROM recordsdetails
    JOIN medias on 
    recordsdetails.MediaId = medias.MediaId
    WHERE DateReturned is NULL
    ');
    $getstmt = $stmt->fetchAll();
    echo json_encode($getstmt);
} catch (PDOException $th) {
    $th->getMessage();
}

?>