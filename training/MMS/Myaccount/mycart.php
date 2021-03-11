<?php
session_start();
// echo $_SESSION['employeecode'];
if(isset($_POST)){
    $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=mediamanagementsystem','root','admin');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
    $stmt = $pdo->query('
    SELECT
    HoldId,
    mediasonhold.MediaId,
    medias.Title,
    mediatypes.MediaTypename,
    medias.StatusId,
    medias.Author,
    medias.YearPub,
    medias.Location
    FROM mediasonhold
    JOIN medias ON
    mediasonhold.MediaId = medias.MediaId
    JOIN mediatypes ON
    medias.MediaTypeId = mediatypes.MediaTypeId
    WHERE mediasonhold.UpdatedByCode = "'.$_SESSION['employeecode'].'"
    AND
    StatusId = 6
    AND
    mediasonhold.DeletedDate Is Null
    ');
    $getstmt = $stmt->fetchAll();
    echo json_encode($getstmt);
}

?>