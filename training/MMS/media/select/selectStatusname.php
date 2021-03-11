<?php
if(isset($_POST)){
    try {
        $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=mediamanagementsystem','root','admin');
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $stmt = $pdo->query('SELECT StatusId, StatusName FROM mediastatus');
        $getstmt = $stmt->fetchAll();
        echo json_encode($getstmt);
    } catch (\Throwable $th) {
        //throw $th;
    }
}

?>