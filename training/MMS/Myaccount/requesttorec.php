<?php
// echo "<pre>";
// print_r($_POST['recordid']);
// echo "</pre>";
// return 0;
session_start();
if (isset($_SESSION)) {
    try {
        $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=mediamanagementsystem', 'root', 'admin');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $stmt = $pdo->prepare('
INSERT INTO records(
    RecordId,
    BorrowerId,
    Remarks,
    CreatedDate,
    UpdatedByCode
) VALUES (
    :a,
    "' . $_SESSION['employeeid'] . '",
    "Request",
    SYSDATE(),
    "' . $_SESSION['employeecode'] . '"
)
');
$stmt->bindValue(':a',$_POST['recordid'],PDO::PARAM_STR);
$stmt->execute();
    } catch (PDOException $th) {
        $th->getMessage();
    }
}
