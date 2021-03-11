<?php
session_start();
// print_r($_POST['title']);
// return 0;
if(isset($_POST)){
    $t = $_POST['author'];
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
        AND Author LIKE '%". $t ."%'
        ");
        $stmt->bindValue(':b',$_SESSION['branchid'],PDO::PARAM_INT);
        $stmt->execute();
        $getstmt = $stmt->fetchAll();
        echo json_encode($getstmt);
    } catch (PDOexception $th) {
        echo $th->getMessage();
    }
}
?>