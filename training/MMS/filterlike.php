<?php
// print_r($_POST['inptitle']);
// print_r($_POST['inptype']);

if(isset($_POST)){
    $t = $_POST['inptitle'];
    $y = $_POST['inptype'];

// $t = "Books";
// print_r($t);

try{
    $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=mediamanagementsystem','root','admin');
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $stmt = $pdo->prepare("SELECT 
    MediaId, medias.MediaTypeId, medias.BranchId, medias.StatusId, Title, mediatypes.MediaTypename
    FROM medias
    JOIN mediatypes 
    ON medias.MediaTypeId = mediatypes.MediaTypeId
    WHERE medias.Title LIKE '%".$t."%' 
    AND medias.DeletedDate is NULL
    AND medias.StatusId = 1");
    // $stmt->bindValue(':a',$t,PDO::PARAM_STR);
    // $stmt->bindValue(':b',$y,PDO::PARAM_STR);
    $stmt->execute();
    $getstmt = $stmt->fetchAll();
    print_r(json_encode($getstmt));
    

}
catch(PDOException $e){
    echo $e->getMessage();
}

}
