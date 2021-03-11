<?php

try {
    $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=mediamanagementsystem','root','admin');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $stmt = $pdo->query('
    SELECT CardNumber,
    branches.Name AS Branch,
    userlevels.UserLevelName,
    employees.Name,
    employees.Address,
    employees.ContactNumber,
    employees.BirthDate,
    employees.Username 
    FROM employees 
    JOIN branches ON
    employees.BranchId = branches.BranchId
    JOIN userlevels ON
    employees.UserLevelId = userlevels.UserLevelid
    WHERE CardNumber LIKE "C%"
    ');
    $getstmt = $stmt->fetchAll();
    echo json_encode($getstmt);
} catch (PDOException $th) {
    $th->getMessage();
}

?>