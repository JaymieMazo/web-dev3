<?php

if(isset($_POST)){
    try {
        $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=mediamanagementsystem','root','admin');
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
        $stmt = $pdo->prepare('SELECT MediaId, medias.MediaTypeId, medias.BranchId, medias.StatusId, Title FROM medias 
        WHERE DeletedDate is NULL
        AND StatusId = 1');
        $stmt->execute();
        $getstmt = $stmt->fetchAll();
        echo json_encode($getstmt);
    } catch (\Throwable $th) {
        //throw $th;
    }
}


?>