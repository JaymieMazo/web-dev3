<?php

if(isset($_POST)){
    $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=mediamanagementsystem','root','admin');
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
    $stmt = $pdo->query("
    SELECT 
    MediaId, 
    mediastatus.StatusName,
    mediatypes.MediaTypename,
    branches.Name,
    Title,
    Author,
    Writer,
    YearPub
    FROM medias
    JOIN mediastatus
    ON
    medias.StatusId = mediastatus.StatusId
    JOIN mediatypes
    ON
    medias.MediatypeId = mediatypes.MediatypeId
    JOIN branches
    ON
    medias.BranchId = branches.BranchId
    WHERE Statusname = 'On Hold'
    ");
    $getstmt = $stmt->fetchAll();
    echo json_encode($getstmt);
}

?>