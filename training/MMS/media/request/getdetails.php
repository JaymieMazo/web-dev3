<?php

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// return 0 ;
if (isset($_POST)){
    $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=mediamanagementsystem','root','admin');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO:: FETCH_ASSOC);
    $stmt = $pdo->prepare('
    SELECT 
    medias.MediaId,
    medias.Title, 
    mediastatus.StatusName,
    mediatypes.MediaTypename
    FROM
    recordsdetails
    JOIN medias ON
    recordsdetails.MediaId = medias.MediaId
    JOIN mediatypes ON 
    medias.MediatypeId = mediatypes.MediaTypeId
    JOIN mediastatus ON
    medias.StatusId = mediastatus.StatusId
    WHERE RecordId = :id
    AND recordsdetails.DeletedDate is NULL
    ');
    $stmt->bindValue(':id',$_POST['id'],PDO::PARAM_STR);
    $stmt->execute();
    $getstmt = $stmt->fetchAll();
    echo json_encode($getstmt);

}

?>