<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Welcome Customer</h1>
    <form action="customer_login.php" method="POST">
    <button type="exit" name="exit" id="exit">Logout</button>
    </form>
    
</body>
</html>


<?php
session_start();
echo $_SESSION['validate'];
if ($_SESSION['validate'] == "valid")
{
   
}
else{
    header("Location:index.php");
    exit();
}
?>