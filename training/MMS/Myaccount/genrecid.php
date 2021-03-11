<?php

try {
    $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=mediamanagementsystem', 'root', 'admin');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $stmt = $pdo->query('SELECT CONCAT(EXTRACT(YEAR_MONTH FROM SYSDATE()),(SELECT COUNT(RecordId)+1 FROM records WHERE SUBSTRING(RecordId,1,4) = EXTRACT(YEAR FROM SYSDATE()))) AS id');
    $getstmt = $stmt->fetchAll();
    echo json_encode($getstmt);
} catch (PDOException $th) {
    $th->getMessage();
}
