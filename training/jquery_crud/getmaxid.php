<?php
                try{
                    $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=test','root','admin');
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                    $max = $pdo->query('SELECT MAX(id) as id from employees');
                    $maxid =$max->fetchAll();
                    // print_r($data);
                    echo json_encode($maxid);
                }catch(PDOException $e){
                    echo $e->getMessage();
                }

                ?>