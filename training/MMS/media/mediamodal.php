<?php
session_start();
// print_r($_POST['MediaId']);
$t = $_POST['MediaId'];
if(isset($_POST)){
    try {
            $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=mediamanagementsystem','root','admin');
            $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $stmt = $pdo->prepare('SELECT 
            MediaId,mediatypes.MediaTypename, 
            branches.Name ,
            medias.MediaTypeId,
            mediastatus.StatusName, 
            Title, Author, 
            Writer,
            YearPub, 
            Location AS MediaLocation, 
            FineLost, 
            FineLate
            FROM medias
            JOIN mediatypes 
            ON medias.MediaTypeId = mediatypes.MediaTypeId
            JOIN branches
            ON medias.BranchId = branches.BranchId
            JOIN mediastatus
            ON medias.StatusId = mediastatus.StatusId
            WHERE MediaId = :a');
            $stmt->bindValue(':a',$t,PDO::PARAM_STR);
            $stmt->execute();
            $getstmt = $stmt->fetchAll();
            echo json_encode($getstmt);
    } catch (PDOException $th) {
        $th->getMessage();    }
}
?>