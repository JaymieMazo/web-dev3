<?php
session_start();
// echo "<pre>";
// print_r($_SESSION['branchid']);
// echo "</pre>";
if (isset($_SESSION)) {
    try {
        $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=mediamanagementsystem', 'root', 'admin');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $stmt = $pdo->prepare("
        SELECT MediaId, medias.MediaTypeId, mediatypes.MediaTypename, medias.BranchId, medias.StatusId, Title FROM medias 
        JOIN mediatypes ON
        medias.MediaTypeId = mediatypes.MediaTypeId
        WHERE medias.DeletedDate is NULL
        And StatusId = 1
        AND BranchId = :b
        ");
        $stmt->bindValue(':b',$_SESSION['branchid'],PDO::PARAM_INT);
        $stmt->execute();
        $getstmt = $stmt->fetchAll();
        echo json_encode($getstmt);
    } catch (\Throwable $th) {
        //throw $th;
    }
}
