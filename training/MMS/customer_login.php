<?php
// print_r($_POST['c_uname']);
// print_r($_POST['c_pass']);

session_start();
if (isset($_POST['submit']))
    $user = $_POST['c_uname'];
$pass = $_POST['c_pass']; {
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=mediamanagementsystem", 'root', 'admin');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $pdo->prepare("SELECT Username,Password AS Userpass FROM customers WHERE Username=:uname AND Password =:upass");
        $stmt->bindValue(':uname', $user, PDO::PARAM_STR);
        $stmt->bindValue(':upass', $pass, PDO::PARAM_STR);
        $stmt->execute();
        $account = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($stmt->rowCount() > 0) {
            if ($user == $account['Username'] and $pass == $account['Userpass']) {
                if($user)
                $_SESSION['webpass'] = true;
                header("location:home_page.php");
            } else {
                echo "<script>alert('Wrong password/Username');</script>";
                header("refresh:0.01;index.php");
            }
        } else {
            echo "<script>alert('Wrong password/Username');</script>";
            header("refresh:0.01;index.php");
        }
    } catch (PDOException $e) {
        echo 'Caught exeption: ', $e->getMessage(), "\n";
        header("refresh:0.01;index.php");
    }
    // header("location:home_page.php");

}

// if (isset($_POST['exit'])) {
//     $_SESSION['webpass'] = "";
//     echo $_SESSION['webpass'];
//     header("Location:index.php");
//     exit();
// }
