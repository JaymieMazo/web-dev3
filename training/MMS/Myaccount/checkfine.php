<?php
session_start();
try {
    $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=mediamanagementsystem','root','admin');
    $pdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $stmt = $pdo->query('
    SELECT * FROM recordsdetails WHERE UpdatedByCode ="'.$_SESSION['employeecode'].'"  AND Fine is NOT NULL AND DateReturned is NULL
    ');
    $getstmt = $stmt->fetchAll();
    echo json_encode($getstmt);
} catch (PDOException $th) {
    $th->getMessage();
}

?>