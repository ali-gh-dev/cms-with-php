<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$db_name = 'cms';

try{
    $conn = new PDO("mysql:host=$servername;dbname=$db_name;charset=utf8mb4",
                    $username,
                    $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

}catch(PDOException $e){
    echo "error : " . $e->getMessage();
}


?>
            