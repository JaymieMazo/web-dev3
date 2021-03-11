<?php

// print_r($_POST['e_uname']);
// print_r($_POST['e_pass']);
session_start();
if (isset($_POST['submit']))
    $empusername = $_POST['e_uname'];
$emppassword = $_POST['e_pass']; {
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=mediamanagementsystem', 'root', 'admin');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $pdo->prepare('SELECT CardNumber, EmployeeId, BranchId, Username, Password, UserLevelId FROM employees WHERE Username=:uname AND Password=:upass AND DeletedDate IS NULL');
        $stmt->bindValue(':uname', $_POST['e_uname'], PDO::PARAM_STR);
        $stmt->bindValue('upass', $_POST['e_pass'], PDO::PARAM_STR);
        $stmt->execute();
        $acc = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($stmt->rowCount() > 0) {
            if ($_POST['e_uname'] == $acc['Username'] and $_POST['e_pass'] == $acc['Password']) {
                if ($acc['UserLevelId'] == 1) {
                    $_SESSION['webpass'] = 'passthrough';
                    $_SESSION['branchid'] = $acc['BranchId'];
                    $_SESSION['employeecode'] = $acc['CardNumber'];
                    $_SESSION['employeeid'] = $acc['EmployeeId'];
                    $_SESSION['userlevel'] = $acc['UserLevelId'];
                    // echo $_SESSION['employeecode'];
                    header("Location:employee_page.php");
                }
                elseif($acc['UserLevelId'] == 2){
                    $_SESSION['validate'] = "valid";
                    $_SESSION['webpass'] = 'passthrough';
                    $_SESSION['branchid'] = $acc['BranchId'];
                    $_SESSION['employeecode'] = $acc['CardNumber'];
                    $_SESSION['employeeid'] = $acc['EmployeeId'];
                    $_SESSION['userlevel'] = $acc['UserLevelId'];
                    header("Location:employee_page.php");
                }
                
            } else {
                echo "<script>alert('Wrong password/Username');</script>";
                header("refresh:0.01;index.php");
            }
        } else {
            echo "<script>alert('Wrong password/Username');</script>";
            header("refresh:0.01;index.php");
        }
    } catch (PDOException $th) {
        echo 'Caught exeption: ', $e->getMessage(), "\n";
        header("refresh:0.01;index.php");
    }
}

if (isset($_POST['exit'])) {
    $_SESSION['webpass'] = "";
    echo $_SESSION['webpass'];
    header("Location:index.php");
    exit();
}
