<?php
session_start();
if(isset($_POST)){
    try {
        $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=mediamanagementsystem','root','admin');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $stmt = $pdo->prepare('
        SELECT 
        RecordId, 
        employees.CardNumber, 
        employees.BranchId,
        Remarks
        FROM records
        JOIN
        employees ON
        records.BorrowerId = employees.EmployeeId
        WHERE records.Remarks = "Request"
        AND BranchId = :b
        ');
        $stmt->bindValue(':b',$_SESSION['branchid']);
        $stmt->execute();
        $getstmt = $stmt->fetchAll();
        echo json_encode($getstmt);
    } catch (PDOException $th) {
        $th->getMessage;
    }
}
?>