<?php
session_start();



// sa monday tanggalin yung webpass sa login tsaka yung session sa homapage para sa presentation





try {
    $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=mediamanagementsystem', 'root', 'admin');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $stmt = $pdo->prepare('
    SELECT 
    recordsdetails.RecordId,
    recordsdetails.MediaId,
    medias.Title,
    mediastatus.StatusName,
    employees.BranchId,
    DateIssued,
    DateDue,
    Fine
    FROM 
    recordsdetails
    JOIN medias ON
    recordsdetails.MediaId = medias.MediaId
    JOIN mediastatus ON
    medias.StatusId = mediastatus.StatusId
    JOIN records ON
    recordsdetails.RecordId = records.RecordId
    JOIN employees ON
    records.BorrowerId = employees.EmployeeId
    WHERE DateReturned is NULL
    AND recordsdetails.RecordId = :r
    AND employees.BranchId = :b
    ');
    $stmt->bindValue(':r',$_POST['recordid'],PDO::PARAM_INT);
    $stmt->bindValue(':b',$_SESSION['branchid']);
    $stmt->execute();
    $getstmt = $stmt->fetchAll();
    echo json_encode($getstmt);
} catch (PDOException $th) {
    echo $th->getMessage();
}
