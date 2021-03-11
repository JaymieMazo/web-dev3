<?php
echo '<pre>';
    print_r($_POST);
    echo '</pre>';
if(isset($_POST)){
    
    $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=mediamanagementsystem','root','admin');
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $stmt = $pdo->prepare("
    UPDATE medias
    SET 
    MediaTypeId = :mtid,
    BranchId = :bid,
    StatusId = :sid,
    StatusId = :sid,
    Title = :t,
    Author = :a,
    Writer= :w,
    YearPub = :y,
    Location = :l,
    FineLost = :flo,
    FineLate=:fla,
    UpdateDate= NOW(),
    UpdatedByCode='39360'

    WHERE MediaId =:mid
    ");
    $stmt->bindValue(':mtid',$_POST['mediatype'],PDO::PARAM_INT);
    $stmt->bindValue(':bid',$_POST['branch'],PDO::PARAM_INT);
    $stmt->bindValue(':sid',$_POST['statusname'],PDO::PARAM_INT);
    $stmt->bindValue(':t',$_POST['mediatitle'],PDO::PARAM_STR);
    $stmt->bindValue(':a',$_POST['author'],PDO::PARAM_STR);
    $stmt->bindValue(':w',$_POST['writer'],PDO::PARAM_STR);
    $stmt->bindValue(':y',$_POST['yearpub'],PDO::PARAM_STR);
    $stmt->bindValue(':l',$_POST['location'],PDO::PARAM_STR);
    $stmt->bindValue(':flo',$_POST['finelost'],PDO::PARAM_STR);
    $stmt->bindValue(':fla',$_POST['finelate'],PDO::PARAM_INT);
    $stmt->bindValue(':mid',$_POST['mediaid'],PDO::PARAM_STR);
    $stmt->execute();
    
    // $getstmt = $stmt->fetchAll();
    // echo json_encode($stmt);
}
   
//     Title = :t,
//     
//     
//     
//     
//     
//     
//     
//     
//     
?>