<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST"){

    require "includes/connection.php";

    $user = $_POST['username'];
    $pass = $_POST['password'];
    $query = "select * from user where username = :u";
    $result = $conn->prepare($query);
    $result->bindParam(':u', $user);
    $result->execute();
    $row = $result->fetch();


    if ($row) {
        // function for hashing password => password_hash('test-password', PASSWORD_DEFAULT)

        // comparison between hashed password in database & entered password
        // $pass => entered password
        // $row['password'] => hashed password in database
        $password_is_true = password_verify($pass, $row['password']);

        if ($password_is_true) {
            $_SESSION['is_logged_in'] = true;
            echo "======== you logged in successfully !  ========";
        }else {
            echo "======== oops. wrong data ! ========";
        }
        
    }else{
        echo "======== oops. wrong data ! ========";
    }

}

?>

<form action="" method="post">
    <label for="">username : </label>
    <input type="text" name="username" required>
    <br>
    <label for="">password : </label>
    <input type="password" name="password" required>
    <br>
    <button class="btn" type="submit">Login</button>
</form>