<?php
session_start();
// echo $_SESSION['employeeid'];
// echo $_SESSION['employeecode'];
// return 0 ;
try {
    $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=mediamanagementsystem','root','admin');
    $pdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $stmt = $pdo->query('SELECT * FROM records where BorrowerId = "'.$_SESSION['employeeid'].'" AND Remarks = "Request"');
    $getstmt = $stmt->fetchAll();
    echo json_encode($getstmt);
} catch (PDOException $th) {
    $th->getMessage();
}
?>