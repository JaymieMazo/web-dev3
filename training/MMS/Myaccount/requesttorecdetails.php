<?php
echo"<pre>";
print_r($_POST);
echo"</pre>";
// return 0;
session_start();
if (isset($_POST)) {
    // insert to recordsdetails
    try {
        $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=mediamanagementsystem', 'root', 'admin');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $stmt = $pdo->prepare("
        INSERT INTO recordsdetails(
            RecordId,
            MediaId,
            DateIssued,
            DateDue,
            CreatedDate,
            UpdatedByCode
        )VALUES(
            :rid,
            :mid,
            CURDATE(),
            DATE_ADD(CURDATE(), INTERVAL 10 DAY),
            SYSDATE(),
            '".$_SESSION['employeecode']."'
        )
        ");
        $stmt->bindValue(':rid',$_POST['recordid'],PDO::PARAM_INT);
        $stmt->bindValue(':mid',$_POST['mediaid'],PDO::PARAM_STR);
        $stmt->execute();
    } catch (PDOException $th) {
        echo $th->getMessage();
    }



    // update medias mediastatus to On Request
    try {
        $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=mediamanagementsystem', 'root', 'admin');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $stmt = $pdo->prepare("
        UPDATE medias SET StatusId = 4 WHERE MediaId = :mid
        ");
        $stmt->bindValue(':mid',$_POST['mediaid'],PDO::PARAM_STR);
        $stmt->execute();
    } catch (PDOException $th) {
        $th->getMessage();
    }

}
