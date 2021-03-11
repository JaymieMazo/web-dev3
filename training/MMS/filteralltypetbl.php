<?php



try {
    $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=mediamanagementsystem', 'root', 'admin');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $stmt = $pdo->query('SELECT 
    MediaId,
    medias.MediaTypeId,
    medias.BranchId,
    medias.StatusId,
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
    WHERE medias.DeletedDate is NULL
    AND medias.StatusId = 1');
    $getstmt = $stmt->fetchAll();
    print_r(json_encode($getstmt));
} catch (PDOException $e) {
    echo $e->getMessage();
}
