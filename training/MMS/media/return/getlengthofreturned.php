<?php

// print_r($_POST)
if (isset($_POST)) {
    try {
        $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=mediamanagementsystem', 'root', 'admin');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $stmt = $pdo->prepare('
        SELECT *
        FROM recordsdetails
        WHERE RecordId = :r
        AND DateReturned is NOT NULL
        ');
        $stmt->bindValue(':r', $_POST['recordid'], PDO::PARAM_INT);
        $stmt->execute();
        $getstmt = $stmt->fetchAll();
        echo json_encode($getstmt);
    } catch (PDOException $th) {
        $th->getMessage();
    }
}
