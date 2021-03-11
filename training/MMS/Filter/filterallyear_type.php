<?php
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// return 0;
if(isset($_POST)){
    $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=mediamanagementsystem','root','admin');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $stmt = $pdo->prepare("SELECT MediaId, medias.MediaTypeId, mediatypes.MediaTypename, medias.BranchId, medias.StatusId, Title FROM medias 
    JOIN mediatypes ON
    medias.MediaTypeId = mediatypes.MediaTypeId
    WHERE medias.DeletedDate is NULL
    And StatusId = 1
    AND MediaTypename = :mt");
    $stmt->bindValue(':mt',$_POST['mediatype'],PDO::PARAM_STR);
    $stmt->execute();
    $getstmt = $stmt->fetchAll();
    print_r(json_encode($getstmt)) ;
    // to be continud tommrow
}

?>