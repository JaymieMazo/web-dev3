<?php

session_start();
try {
    $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=mediamanagementsystem', 'root', 'admin');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $stmt = $pdo->prepare('
    SELECT 
    recordsdetails.RecordId,recordsdetails.MediaId,DateIssued,DateDue,employees.CardNumber,recordsdetails.Fine,medias.Title
    FROM recordsdetails
    JOIN records ON
    recordsdetails.RecordId = records.RecordId
    JOIN employees ON
    records.BorrowerId = employees.EmployeeId
    JOIN medias ON
    recordsdetails.MediaId = medias.MediaId
    WHERE CardNumber = :ec AND
    recordsdetails.Fine IS NOT NULL
    ');
    $stmt->bindValue(':ec',$_SESSION['employeecode'],PDO::PARAM_STR);
    $stmt->execute();
    $getstmt = $stmt->fetchAll();
    echo json_encode($getstmt);
} catch (PDOException $th) {
    echo $th->getMessage();
}


?>