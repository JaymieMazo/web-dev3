<?php

try {
    $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=mediamanagementsystem', 'root', 'admin');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $stmt = $pdo->query('
    SELECT 
    recordsdetails.RecordId, 
    recordsdetails.MediaId,
    medias.Title,
    employees.CardNumber,
    DateIssued, 
    DateDue, 
    Fine 
    FROM recordsdetails
    JOIN medias ON
    recordsdetails.MediaId = medias.MediaId 
    JOIN records ON
    recordsdetails.RecordId = records.RecordId
    JOIN employees ON 
    records.BorrowerId = employees.EmployeeId
    WHERE Fine IS NOT NULL
    ');
    $getstmt = $stmt->fetchAll();
    echo json_encode($getstmt);
} catch (PDOException $th) {
    echo $th->getMessage();
}
