<?php
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

if(isset($_POST)){
$t = $_POST['likeinpauthor'];
try {
    $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=mediamanagementsystem', 'root', 'admin');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $stmt = $pdo->prepare("SELECT MediaId, medias.MediaTypeId,mediatypes.MediaTypename, medias.BranchId, medias.StatusId, Title FROM medias 
    JOIN mediatypes ON
    medias.MediaTypeId = mediatypes.MediaTypeId
    WHERE Author LIKE '%".$t."%'
    AND MediaTypename = :typ
    AND medias.DeletedDate is NULL
    AND StatusId = 1");
    $stmt->bindValue(':typ',$_POST['medtype'],PDO::PARAM_STR);
    // $stmt->bindValue(':a',$t,PDO::PARAM_STR);
    $stmt->execute();
    $getstmt = $stmt->fetchAll();
    echo json_encode($getstmt);
} catch (PDOException $th) {
    echo $th->getMessage();
}

}

?>