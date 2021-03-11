<?php
if(isset($_POST)){
    $t = $_POST['inputyear'];
    // echo $t;
    try {
        $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=mediamanagementsystem', 'root', 'admin');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $stmt = $pdo->prepare("SELECT MediaId, medias.MediaTypeId, medias.BranchId, medias.StatusId, Title FROM medias 
        WHERE YearPub = :a 
        AND DeletedDate is NULL
        And StatusId = 1");
        $stmt->bindValue(':a',$t,PDO::PARAM_STR);
        $stmt->execute();
        $getstmt = $stmt->fetchAll();
        print_r(json_encode($getstmt)) ;
    } catch (PDOException $th) {
        $th->getMessage();
    }
}

?>