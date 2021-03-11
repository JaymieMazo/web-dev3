<?php
include 'dbConnection.php';
$db = new DBConn();

print_r($db);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OOP Login</title>
</head>

<body>
    <br>
    <label for="username">Username:</label>
    <input name="username" type="text">
    <br>
    <label for="password">Password:</label>
    <input name="password" type="password">
</body>

</html>