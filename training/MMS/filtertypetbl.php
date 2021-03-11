<?php
// print_r($_POST['mediaType']);

if (isset($_POST)) {
    $t = $_POST['mediaType'];
    // $t = "Books";
    // print_r($t);

    try {
        $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=mediamanagementsystem', 'root', 'admin');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $stmt = $pdo->prepare('SELECT 
    MediaId,
    medias.MediaTypeId,
    medias.BranchId,
    medias.StatusId,
    mediatypes.MediaTypename,
    mediastatus.StatusName, 
    Title, 
    Author, 
    Writer, 
    YearPub,
    Location AS mediaLocation
    FROM medias      
    JOIN mediatypes ON medias.MediaTypeId = mediatypes.MediaTypeId
    JOIN mediastatus ON medias.StatusId = mediastatus.StatusId
    WHERE MediaTypename = :a 
    AND medias.DeletedDate is NULL
    AND medias.StatusId = 1' );
        $stmt->bindValue(':a', $t, PDO::PARAM_STR);
        $stmt->execute();
        $getstmt = $stmt->fetchAll();
        print_r(json_encode($getstmt));
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
