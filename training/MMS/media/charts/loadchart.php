<?php
$timezone = date_default_timezone_set('Asia/Manila');
$ststdate = null;
$to = null;
if($_POST['from'] == null){
    $ststdate = date('Y-m-01 ');
}else{
    $ststdate = $_POST['from'];
}

if($_POST['to'] == null){
    $to = date('Y-m-d');
}else{
    $to = $_POST['to'];
}

try{
$pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=mediamanagementsystem','root','admin');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$stmt = $pdo->prepare("
SELECT medias.Title, COUNT(recordsdetails.MediaId) AS TOTAL FROM recordsdetails
JOIN medias ON
recordsdetails.MediaId = medias.MediaId
WHERE DateIssued BETWEEN :f AND :t
GROUP BY medias.Title 
ORDER BY COUNT(recordsdetails.MediaId) DESC
");
$stmt->bindValue(':f',$ststdate);
$stmt->bindValue(':t',$to);
$stmt->execute();
$getdata = $stmt->fetchAll();
$total = 0;
foreach($getdata as $key=>$val){
    $total += $val['TOTAL'];
}
foreach($getdata as $key=>$val){
    $getdata[$key]['percent'] = ($val['TOTAL'] / $total) * 100; 
}
echo json_encode($getdata);
}catch(PDOException $e){
    echo $e->getMessage();
}


?>